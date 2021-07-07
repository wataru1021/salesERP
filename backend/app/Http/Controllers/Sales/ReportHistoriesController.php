<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleDailyReport;
use Carbon\Carbon;

class ReportHistoriesController extends Controller
{
    public function index()
    {
        // $saleDailyReport = SaleDailyReport::sum('ping_pong_num')->sum('meet_num');
        $saleDailyReport = SaleDailyReport::selectRaw('sum(ping_pong_num) as ping_pong_num')
        ->selectRaw('sum(meet_num) as meet_num')
        ->selectRaw('sum(deal_num) as deal_num')
        ->selectRaw('sum(acquisitions_num) as acquisitions_num')
        ->selectRaw('sum(sale_time) as sale_time')
        ->get();
        return view('sales.reporthistories', ['saleDailyReport' => $saleDailyReport]);
    }

    public function reportHistories(Request $request)
    {
        $saleDailyReport = SaleDailyReport::whereDate('report_date', '>=', Carbon::parse($request->start_date))
        ->whereDate('report_date', '<=', Carbon::parse($request->end_date))
        ->selectRaw('sum(ping_pong_num) as ping_pong_num')
        ->selectRaw('sum(meet_num) as meet_num')
        ->selectRaw('sum(deal_num) as deal_num')
        ->selectRaw('sum(acquisitions_num) as acquisitions_num')
        ->selectRaw('sum(sale_time) as sale_time')
        ->get();
        return response()->json($saleDailyReport, 200);
    }
}
