<?php

namespace App\Http\Controllers\Sales;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleDailyReport;
use App\Models\User;
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
            $builder = User::query()->leftJoin('sale_daily_reports', function ($join) use ($request) {
                $join->on('users.id', '=', 'sale_daily_reports.user_id')
                    ->whereDate('report_date', '>=', Carbon::parse($request->start_date))
                    ->whereDate('report_date', '<=', Carbon::parse($request->end_date));
                })->where('user_id', Auth::guard('sales')->user()->id)
                ->selectRaw('
                    sum(ping_pong_num) as ping_pong_num,
                    sum(meet_num) as meet_num,
                    sum(deal_num) as deal_num,
                    sum(acquisitions_num) as acquisitions_num,
                    sum(sale_time) as sale_time
                    ')->get();
            return response()->json([
                'status' => StatusCode::OK,
                'data' => $builder
            ], StatusCode::OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => StatusCode::NOT_FOUND,
                'data' => $builder
            ], StatusCode::NOT_FOUND);
        }
    }
}
