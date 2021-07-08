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

    public function forgotPassword(Request $request)
    {
        return view('admin.users.password.forgot');
    }

    public function successPassword(Request $request)
    {
        return view('admin.users.password.success');
    }

    public function successEmail(Request $request)
    {
        return view('admin.users.password.successemail');
    }

    public function setToken(ForgotRequest $request)
    {
        $message = '';

        $token = bin2hex(random_bytes(64));
        $time = Carbon::now()->addDays(LimitTimeForgot::TIMEFORGOT);

        $user = User::where('email', $request->email_address)->where('role_id', RoleStateType::MANAGERMENT)->first();

        if ($user) {
            $user->reset_password_token = $token;
            $user->reset_password_token_expire =  $time;
            $flag = $user->save();

            if ($flag) {
                Mail::send('admin.mail.resetPassword', ['token' => $token], function ($message) use ($request) {
                    $message->to($request->email_address);
                });
                return redirect('/admin/successEmail');
            }
        } else {
            $message = 'メールは存在しません';
        }

        return view('admin.users.password.forgot', [
            'message' => $message,
        ]);
    }

    public function getToken(Request $request)
    {
        $token = explode("/", url()->current())[5];
        return view('admin.users.password.change', [
            'token' => $token
        ]);
    }

    public function resetPassword(ChangeRequest $request)
    {
        $user = User::where('reset_password_token', $request->reset_password_token)->whereDate('reset_password_token_expire', '>', Carbon::now())->first();

        if ($user) {
            $user->password = Hash::make($request->password_confirm);
            $user->save();
            return redirect('/admin/successPassword');
        } else {
            $message = 'ログインセッションの有効期限が切れました。再入力してください';
            return view('admin.users.password.forgot', [
                'message' => $message,
            ]);
        }
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
        $usersQuery = User::query()->where(['role_id' => RoleStateType::SALER]);
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
