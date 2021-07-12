<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LimitTimeForgot;
use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Enums\RoleStateType;
use App\Enums\MaxPageSize;
use App\Http\Requests\Admin\Password\ChangeRequest;
use App\Http\Requests\Admin\Password\ForgotRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function index(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect(route('admin.home'));
        }
        return view('admin.users.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['role_id'] = RoleStateType::MANAGERMENT;

        $message = '';
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect(route('admin.home'));
        } else {
            $message = '入力したメールアドレスとパスワードをご確認ください';
        }

        return view('admin.users.login', [
            'message' => $message,
        ]);
    }

    public function change_password_complete(Request $request)
    {
        return view('admin.users.password.success');
    }

    public function change_password_error(Request $request)
    {
        return view('admin.users.password.error');
    }

    public function forgot_password_complete(Request $request)
    {
        return view('admin.users.password.successemail');
    }

    public function forgot_password_error(Request $request)
    {
        return view('admin.users.password.erroremail');
    }

    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.users.password.forgot');
        }

        if ($request->isMethod('post')) {
            $message = '';
            $token = bin2hex(random_bytes(64));
            $time = Carbon::now()->addDays(LimitTimeForgot::TIMEFORGOT);

            $user = User::where('email', $request->email_address)->where('role_id', RoleStateType::MANAGERMENT)->first();

            if ($user) {
                $user->reset_password_token = $token;
                $user->reset_password_token_expire =  $time;
                $flag = $user->save();

                if ($flag) {
                    Mail::send('admin.mail.resetPassword', ['token' => $token, 'email' => $request->email_address], function ($message) use ($request) {
                        $message->to($request->email_address);
                    });
                    return redirect('admin/forgot-password-complete');
                }
            } else {
                return redirect('admin/forgot-password-error');
            }
        }
    }

    public function getToken(Request $request)
    {
        $email = explode("/", url()->current())[5];
        $tokenUrl = explode("/", url()->current())[6];
        $message = '';

        $user = User::where('email', $email)->first();
        if (!$user) {
            $message = 'Incorrect email address';
        } elseif ($user->reset_password_token != $tokenUrl) {
            $message = 'Incorrect Tokens';
        } elseif (Carbon::parse($user->reset_password_token_expire)->lessThanOrEqualTo(Carbon::now())) {
            $message = 'Expired Tokens';
        }
        return view('admin.users.password.change', [
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
                return redirect('/admin/change-password-complete');
            } else {
                $message2 = 'パスワードの変更に失敗しました';
            }
        } else {
            $message2 = 'ログインセッションの有効期限が切れました。再入力してください';
        }
        return view('admin.users.password.error', [
            'message2' => $message2,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }

    /**
     *  Remove user
     * 
     *  @param int $id 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function remove($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return redirect()->route('adminUsers');
    }

    /**
     *  Show the form for editing the user.
     * 
     *  @param int $id
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function editForm($id)
    {
        $user = User::find($id);
        return view('dashboard.admin.userEditForm', compact('user'));
    }

    public function edit()
    {
    }

    public function list(Request $request)
    {
        if (!Auth::guard('admin')->check()) return view('admin.users.login');
        $breadcrumbs = [
            '営業マン管理'
        ];
        return view('admin.users.List', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function getUserlist(Request $request)
    {
        if (!Auth::guard('admin')->check()) return view('admin.users.login');
        $orderBy = $request->input('column');
        $orderBy = ($orderBy == "created_at_format") ? "created_at" : $orderBy;
        $orderByDir = $request->input('dir', 'asc');
        $usersQuery = User::query()->where([
            'role_id' => RoleStateType::SALER,
            'company_id' =>  Auth::guard('admin')->user()->company_id
        ]);
        switch ($orderByDir) {
            case 'asc':
                $usersQuery->orderBy($orderBy);
                break;
            case 'desc':
                $usersQuery->orderByDesc($orderBy);
                break;
        }
        return new DataTableCollectionResource($usersQuery->paginate(MaxPageSize::MAX_PAGE_SIZE, ['*'], 'page', $request->page));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->delete();
            DB::commit();
            return response()->json([], StatusCode::OK);
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return response()->json([], StatusCode::INTERNAL_ERR);
    }
}
