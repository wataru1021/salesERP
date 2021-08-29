<?php

namespace App\Http\Controllers\Sales;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('sales')->check()) {
            $userId = Auth::guard('sales')->id();
            $data = Appointment::where('user_id', $userId)
                ->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->get();
            return view('sales.appointments.index', [
                'data' => $data,
            ]);
        }
        return view('sales.users.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $appointment = new Appointment();
            $appointment->user_id = Auth::guard('sales')->id();
            $appointment->appointee_name = $request->appointee_name;
            $appointment->appointment_address = $request->appointment_address;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->appointment_time = $request->appointment_time;
            $appointment->appointment_memo = $request->appointment_memo;
            $appointment->save();
            return response()->json(["status" => true], StatusCode::OK);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), StatusCode::INTERNAL_ERR);
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
