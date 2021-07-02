<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Enums\RoleStateType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    public function index(Request $request) {
        if (Auth::guard('web')->check()) {
            return redirect(route('admin.home'));
        }
        return view('admin.users.login');
    }

    public function login(Request $request)
    {
            $credentials = $request->only('email', 'password');
            $credentials['role_id'] = RoleStateType::MANAGERMENT;
            
            $message = '';
            if (Auth::guard('web')->attempt($credentials)) {
                return redirect(route('admin.home'));
            } else {
                $message = '入力したメールアドレスとパスワードをご確認ください';
            }

        return view('admin.users.login');
    }

    public function forgotPassword(Request $request) {

    }
    
    public function logout(Request $request) {
        Auth::guard('web')->logout();
        return redirect(route('admin.login'));
    }

    /**
     *  Remove user
     * 
     *  @param int $id 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function remove( $id )
    {
        $user = User::find($id);
        if($user){
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
    public function editForm( $id )
    {
        $user = User::find($id);
        return view('dashboard.admin.userEditForm', compact('user'));
    }

    public function edit(){

    }

}
