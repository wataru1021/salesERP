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
        return view('sales.DailyReports.create');
    }

    public function store(DailyReportStoreRequest $request)
    {
        try {
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
            $message = '';
            if ($dailyReport) {
                return redirect()->route('daily-report.complete', $dailyReport->id);
            } else {
                $message = '日報新規追加は失敗しました';
            }
            return view('sales.DailyReports.create', [
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function complete($id)
    {
        $dailyReport = SaleDailyReport::find($id);
        return view('sales.DailyReports.complete', [
            'data' => $dailyReport
        ]);
    }
}
