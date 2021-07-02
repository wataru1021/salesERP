<?php

namespace App\Http\Controllers\Sales;

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
        return view('admin.users.login');
    }

    public function login(Request $request)
    {
        dump($request->method());die;   
            $credentials = $request->only('email', 'password');
            $credentials['role_id'] = RoleStateType::MANAGERMENT;
            
            $message = '';
            if (Auth::guard('web')->attempt($credentials)) {
                $userInfo = User::where('id', Auth::id())->with(['userRole', 'userRole.role'])->firstOrFail();
                $isPermission = false;
                if (!empty($userInfo) && !empty($userInfo->userRole)) {
                    foreach ($userInfo->userRole as $userRole) {
                        if ($userRole->role->role_type == RoleStateType::MANAGERMENT && $userRole->role->id != RoleStateType::SALER) {
                            $isPermission = true;
                        }
                    }
                }

                if (!$isPermission) {
                    // Auth::guard('managerment')->logout();

                    return view('Admin.login', [
                        'message' => 'ログインできません',
                    ]);
                }

                $userInfo->save();

                return redirect(route('admin.dashboard'));
            } else {
                $message = '入力したメールアドレスとパスワードをご確認ください';
            }

        return view('admin.users.login');
    }

    public function forgotPassword(Request $request) {

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
