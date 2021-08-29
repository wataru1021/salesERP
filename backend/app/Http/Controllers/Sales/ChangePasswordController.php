<?php

namespace App\Http\Controllers\Sales;

use App\Http\Requests\Sales\LoginChangePassword\LoginChangePasswordRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::guard('sales')->check()) return view('sales.users.login');
        $breadcrumbs = [
            'パスワード変更'
        ];
        return view('sales.changePassword.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Show the page change pass complete
     *
     */
    public function complete()
    {
        return view('sales.changePassword.complete');
    }

    /**
     * Show the page change pass error
     *
     */
    public function error()
    {
        return view('sales.changePassword.error');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * post method update new password
     *
     */
    public function update(LoginChangePasswordRequest $request)
    {
        if (!Auth::guard('sales')->check()) return view('sales.users.login');
        $you = User::where('id', Auth::guard('sales')->user()->id)->first();
        $you->password = Hash::make($request->password);
        $you->updated_at = Carbon::now();
        if (!$you->save()) redirect()->route('sales.changePassword.error');
        return redirect()->route('sales.changePassword.complete');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
