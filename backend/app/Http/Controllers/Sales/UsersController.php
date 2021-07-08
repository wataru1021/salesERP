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
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Hash;
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
            return redirect(route('home'));
        } else {
            $message = '入力したメールアドレスとパスワードをご確認ください';
        }

        return view('sales.users.login', [
            'message' => $message,
        ]);
    }

    public function forgotPassword(Request $request)
    {
        return view('sales.users.password.forgot');
    }

    public function successPassword(Request $request)
    {
        return view('sales.users.password.success');
    }

    public function successEmail(Request $request)
    {
        return view('sales.users.password.successemail');
    }

    public function setToken(ForgotRequest $request)
    {
        $message = '';

        $token = bin2hex(random_bytes(64));
        $time = Carbon::now()->addDays(LimitTimeForgot::TIMEFORGOT);

        $user = User::where('email', $request->email_address)->where('role_id', RoleStateType::SALER)->first();

        if ($user) {
            $user->reset_password_token = $token;
            $user->reset_password_token_expire =  $time;
            $flag = $user->save();

            if ($flag) {
                Mail::send('sales.mail.resetPassword', ['token' => $token], function ($message) use ($request) {
                    $message->to($request->email_address);
                });
                return redirect('/successEmail');
            }
        } else {
            $message = 'メールは存在しません';
        }

        return view('sales.users.password.forgot', [
            'message' => $message,
        ]);
    }


    public function getToken(Request $request)
    {
        $token = explode("/", url()->current())[4];
        return view('sales.users.password.change', [
            'token' => $token
        ]);
    }

    public function resetPassword(ChangeRequest $request)
    {
        $user = User::where('reset_password_token', $request->reset_password_token)->whereDate('reset_password_token_expire', '>', Carbon::now())->first();

        if ($user) {
            $user->password = Hash::make($request->password_confirm);
            $user->save();
            return redirect('/successPassword');
        } else {
            $message = 'ログインセッションの有効期限が切れました。再入力してください';
            return view('sales.users.password.forgot', [
                'message' => $message,
            ]);
        }
    }
}
