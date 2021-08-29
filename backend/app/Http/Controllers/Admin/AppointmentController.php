<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleStateType;
use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [
                'name' => 'データ管理',
                'url' => route('admin.reportManagement')
            ], 'アポイント管理'
        ];
        $users = User::where('role_id', RoleStateType::SALER)->get();
        $data = Appointment::withTrashed()->orderBy('id', 'DESC')->get();
        return view('admin.appointments.index', [
            'breadcrumbs' => $breadcrumbs,
            'userResponse' => $users,
        ]);
    }
    public function getData()
    {
        try{
            $data = Appointment::withTrashed()->orderBy('id', 'DESC')->get();
            return response()->json($data, StatusCode::OK);
        } catch (Exception $e){
            return response()->json(['error' => $e->getMessage()], StatusCode::INTERNAL_ERR);
        }
    }
    public function destroy($id)
    {
        try{
            Appointment::find($id)->delete();
            return response()->json(["status" => true], StatusCode::OK);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), StatusCode::INTERNAL_ERR);
        }
    }
}
