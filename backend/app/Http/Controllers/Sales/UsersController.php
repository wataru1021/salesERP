<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Enums\RoleStateType;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
    }

    public function register(Request $request)
    {
        return view('sales.users.register');
    }

    public function registerPost(Request $request)
    {
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

            $credentials = $request->only('email', 'password');
            $credentials['role_id'] = RoleStateType::SALER;

            $message = '';
            if (Auth::guard('sales')->attempt($credentials)) {
                return redirect(route('home'));
            } else {
                return view('sales.users.register', [
                    'message' => 'アカウント登録に失敗しました',
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password
                ]);
            }
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
