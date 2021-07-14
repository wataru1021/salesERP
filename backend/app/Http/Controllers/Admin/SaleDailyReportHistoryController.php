<?php

namespace App\Http\Controllers\admin;

use App\Enums\RoleStateType;
use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Models\SaleDailyReport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleDailyReportHistoryController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [
                'name' => '全営業マンの報告管理',
                'url' => route('admin.reportManagement')
            ], '営業マン毎の営業成績'
        ];
        $users = User::where('role_id', RoleStateType::SALER)->get();
        return view('admin.SaleDailyReportHistories.index', [
            'breadcrumbs' => $breadcrumbs,
            'userResponse' => $users
        ]);
    }

    public function getData(Request $request)
    {
        try {
            $startDate = Carbon::parse($request->startDate);
            $endDate = Carbon::parse($request->endDate);
            $saleDailyReports = DB::table('sale_daily_reports')
                ->where(function ($q) use ($startDate, $endDate) {
                    if ($startDate) {
                        $q->whereDate('created_at', '>=', $startDate);
                    }
                    if ($endDate) {
                        $q->whereDate('created_at', '<=', $endDate);
                    }
                })
                ->select('user_id', DB::raw(
                    'SUM(ping_pong_num) as ping_pong_num,
                                     SUM(acquisitions_num) as acquisitions_num, SUM(sale_time) / 24 as sale_time,
                                     SUM(acquisitions_num) / SUM(ping_pong_num) * 100  as contract_rate,
                                     SUM(acquisitions_num) / SUM(sale_time)  as productivity,
                                     SUM(meet_num) / SUM(ping_pong_num) * 100  as meet_rate,
                                     SUM(deal_num) / SUM(ping_pong_num) * 100  as deal_rate,
                                     SUM(ping_pong_num) / SUM(sale_time) * 100  as ping_pong_num_one_hour'
                ))
                ->groupBy('user_id')
                ->get();

            return response()->json($saleDailyReports, StatusCode::OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], StatusCode::NOT_FOUND);
        }
    }
}
