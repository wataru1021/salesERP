<?php

namespace App\Http\Controllers\Sales;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleDailyReport;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class ReportHistoriesController extends Controller
{
    public function index()
    {
        return view('sales.reporthistories');
    }

    public function reportHistories(Request $request)
    {
        try {
            $saleDailyReport = SaleDailyReport::where('user_id', Auth::guard('sales')->user()->id)
                ->whereDate('report_date', '>=', Carbon::parse($request->start_date))
                ->whereDate('report_date', '<=', Carbon::parse($request->end_date))
                ->selectRaw('sum(ping_pong_num) as ping_pong_num')
                ->selectRaw('sum(meet_num) as meet_num')
                ->selectRaw('sum(deal_num) as deal_num')
                ->selectRaw('sum(acquisitions_num) as acquisitions_num')
                ->selectRaw('sum(sale_time) as sale_time')
                ->get();
            return response()->json([
                'status' => StatusCode::OK,
                'data' => $saleDailyReport
            ], StatusCode::OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => StatusCode::NOT_FOUND,
                'data' => $saleDailyReport
            ], StatusCode::NOT_FOUND);
        }
    }
}
