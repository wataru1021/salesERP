<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\DailyReportStoreRequest;
use App\Models\SaleDailyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{
    public function create()
    {
        $data = SaleDailyReport::where('user_id', Auth::guard('sales')->user()->id)->whereDate('report_date', Carbon::now()->format('Y-m-d'))->first();
        return view('sales.dailyReports.create', [
            'data' => $data
        ]);
    }

    public function store(DailyReportStoreRequest $request)
    {
        try {
            $data = SaleDailyReport::where('user_id', Auth::guard('sales')->user()->id)->whereDate('report_date', Carbon::now()->format('Y-m-d'))->first();
            $message = '';
            if ($data) {
                $dailyReport = SaleDailyReport::where('id', $data->id)
                    ->update([
                        'ping_pong_num' => $request->ping_pong_num,
                        'meet_num' => $request->meet_num,
                        'deal_num' => $request->deal_num,
                        'acquisitions_num' => $request->acquisitions_num,
                        'sale_time' => $request->sale_time,
                        'conscious_point' => $request->conscious_point
                    ]);
                if ($dailyReport) {
                    return redirect()->route('dailyReport.complete', $data->id);
                } else {
                    $message = '日報新規追加は失敗しました';
                }
                return view('sales.dailyReports.create', [
                    'message' => $message,
                ]);
            } else {
                $dailyReport = SaleDailyReport::create([
                    'user_id' => Auth::guard('sales')->user()->id,
                    'report_date' => Carbon::now()->format('Y-m-d'),
                    'ping_pong_num' => $request->ping_pong_num,
                    'meet_num' => $request->meet_num,
                    'deal_num' => $request->deal_num,
                    'acquisitions_num' => $request->acquisitions_num,
                    'sale_time' => $request->sale_time,
                    'conscious_point' => $request->conscious_point
                ]);
                if ($dailyReport) {
                    return redirect()->route('dailyReport.complete', $dailyReport->id);
                } else {
                    $message = '日報新規追加は失敗しました';
                }
                return view('sales.dailyReports.create', [
                    'message' => $message,
                ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function complete($id)
    {
        $dailyReport = SaleDailyReport::find($id);
        return view('sales.dailyReports.complete', [
            'data' => $dailyReport
        ]);
    }
}
