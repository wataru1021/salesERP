<?php

namespace App\Http\Controllers\Sales;

use App\Enums\LimitTimeForgot;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Enums\RoleStateType;
use App\Http\Requests\Sales\Password\ChangeRequest;
use App\Http\Requests\Sales\Password\ForgotRequest;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function index(Request $request)
    {
        if (Auth::guard('sales')->check()) {
            return redirect(route('home'));
        }
        return view('sales.users.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['role_id'] = RoleStateType::SALER;

        $message = '';
        if (Auth::guard('sales')->attempt($credentials)) {
            $account = User::where('id', Auth::guard('sales')->user()->id)->firstOrFail();
            $account->last_login_at = Carbon::now();
            if (!$account->save()) {
                Auth::guard('sales')->logout();
                return view('sales.users.login');
            }
            return redirect(route('home'));
        } else {
            $message = '入力したメールアドレスとパスワードをご確認ください';
        }

        return view('sales.users.login', [
            'message' => $message,
            'old_email' => $request->email,
            'old_password' => $request->password,
        ]);
    }

    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('sales.users.password.forgot');
        }

        if ($request->isMethod('post')) {
            $message = '';
            $token = bin2hex(random_bytes(64));
            $time = Carbon::now()->addDays(LimitTimeForgot::TIMEFORGOT);

            $user = User::where('email', $request->email_address)->where('role_id', RoleStateType::SALER)->first();

            if ($user) {
                $user->reset_password_token = $token;
                $user->reset_password_token_expire =  $time;
                $flag = $user->save();

                if ($flag) {
                    Mail::send('sales.mail.resetPassword', ['token' => $token, 'email' => $request->email_address], function ($message) use ($request) {
                        $message->to($request->email_address);
                    });
                    return redirect('/forgot-password-complete');
                }
            } else {
                $message = 'メールは存在しません。';
            }

            return view('sales.users.password.forgot', [
                'message' => $message,
                'old_email' => $request->email_address
            ]);
        }
    }

    public function change_password_complete(Request $request)
    {
        return view('sales.users.password.success');
    }

    public function forgot_password_complete(Request $request)
    {
        return view('sales.users.password.successemail');
    }

    public function getToken(Request $request)
    {
        $email = explode("/", url()->current())[4];
        $tokenUrl = explode("/", url()->current())[5];

        $message = '';
        $user = User::where('email', $email)->first();
        if (!$user) {
            $message = 'メールアドレスが正しくないです。';
        } elseif ($user->reset_password_token != $tokenUrl) {
            $message = 'トークンが正しくないです。';
        } elseif (Carbon::parse($user->reset_password_token_expire)->lessThanOrEqualTo(Carbon::now())) {
            $message = 'トークンが期限切れになったです。';
        }

        return view('sales.users.password.change', [
            'tokenUrl' => $tokenUrl,
            'message' => $message,
        ]);
    }

    public function resetPassword(ChangeRequest $request)
    {
        $message2 = '';
        $user = User::where('reset_password_token', $request->reset_password_token)->whereDate('reset_password_token_expire', '>', Carbon::now())->first();
        if ($user) {
            $user->password = Hash::make($request->password_confirm);
            $flag = $user->save();
            if ($flag) {
                return redirect('/change-password-complete');
            } else {
                $message2 = 'パスワードの変更に失敗しました';
            }
        } else {
            $message2 = 'トークンが期限切れになったです。';
        }
        return view('sales.users.password.forgot', [
            'message2' => $message2,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('sales')->logout();
        return redirect(route('login'));
    }

    public function register(Request $request)
    {
        if (Auth::guard('sales')->check()) {
            return redirect(route('home'));
        }
        return view('sales.users.register');
    }

    public function registerPost(Request $request)
    {
        if (Auth::guard('sales')->check()) {
            return redirect(route('home'));
        }
        
        $validator = Validator::make($request->all(), [
            'email' => ['unique:users'],
        ]);
        if ($validator->fails()) {
            return view('sales.users.register', [
                'messageEmail' => 'メールは既に存在します',
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
        }

        try {
            $user =  User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => RoleStateType::SALER,
                'password' => Hash::make($request->password),
                'company_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
            return redirect(route('login'));

        } catch (Exception $e) {
            return view('sales.users.register', [
                'message' => 'アカウント登録に失敗しました',
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
        }
    }
}
