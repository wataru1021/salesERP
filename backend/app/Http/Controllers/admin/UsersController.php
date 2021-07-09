<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Enums\RoleStateType;
use App\Enums\MaxPageSize;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    public function index(Request $request) {
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

    public function forgotPassword(Request $request) {

    }
    
    public function logout(Request $request) {
        Auth::guard('admin')->logout();
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

    public function list(Request $request) {
        if (!Auth::guard('admin')->check()) return view('admin.users.login');
        $breadcrumbs = [
           '営業マン管理'
        ];
        return view('admin.users.List', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function getUserlist(Request $request) {
        if (!Auth::guard('admin')->check()) return view('admin.users.login');
        $orderBy = $request->input('column');
        $orderBy = ($orderBy == "created_at_format") ? "created_at" : $orderBy;
        $orderByDir = $request->input('dir', 'asc');
        $usersQuery = User::query()->where([
            'role_id' => RoleStateType::SALER,
            'company_id' =>  Auth::guard('admin')->user()->company_id
        ]);
        switch ($orderByDir){
            case 'asc' :
                $usersQuery->orderBy($orderBy);
                break;
            case 'desc' :
                $usersQuery->orderByDesc($orderBy);
                break;
        }
        return new DataTableCollectionResource($usersQuery->paginate(MaxPageSize::MAX_PAGE_SIZE, ['*'], 'page', $request->page));
    }

    public function destroy($id) {
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
