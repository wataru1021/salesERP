<?php

namespace App\Http\Controllers\admin;

use App\Enums\RoleStateType;
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
                'url' => ''

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
        $startDate = Carbon::parse($request->startDate);
        $endDate = Carbon::parse($request->endDate);
        $user_id = $request->user_id;
        $saleDailyReports = SaleDailyReport::where('user_id', $user_id)->where(function ($q) use ($startDate, $endDate) {
            if ($startDate) {
                $q->whereDate('created_at', '>=', $startDate);
            }
            if ($endDate) {
                $q->whereDate('created_at', '<=', $endDate);
            }
        })
            ->selectRaw('sum(ping_pong_num) as ping_pong_num')
            ->selectRaw('sum(acquisitions_num) as acquisitions_num')
            ->selectRaw('sum(sale_time) / 24 as sale_time')
            ->selectRaw('sum(acquisitions_num) / sum(ping_pong_num) * 100  as contract_rate')
            ->selectRaw('sum(acquisitions_num) / sum(sale_time)  as productivity')
            ->selectRaw('sum(meet_num) / sum(ping_pong_num) * 100  as meet_rate')
            ->selectRaw('sum(deal_num) / sum(ping_pong_num) * 100  as deal_rate')
            ->selectRaw('sum(ping_pong_num) / sum(sale_time) * 100  as ping_pong_num_one_hour')
            ->get();


        

        return response()->json([$saleDailyReports]);
    }
}
