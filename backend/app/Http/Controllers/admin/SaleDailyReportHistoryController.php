<?php

namespace App\Http\Controllers\admin;

use App\Enums\RoleStateType;
use App\Http\Controllers\Controller;
use App\Models\SaleDailyReport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SaleDailyReportHistoryController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [
                'name' => 'TOP',
                'url' => ''

            ],
            [
                'name' => '全営業マンの報告管理',
                'url' => ''

            ], '営業マン毎の営業成績'
        ];
        return view('admin.SaleDailyReportHistories.index', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function getData(Request $request)
    {   
        // return response()->json($request->startDate);
        $startDate = Carbon::parse($request->startDate);
        $endDate = Carbon::parse($request->endDate);
        $saleDailyReports = SaleDailyReport::where(function ($q) use ($startDate, $endDate) {
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

        
            $dataUser = SaleDailyReport::where(function ($q) use ($startDate, $endDate) {
                if ($startDate) {
                    $q->whereDate('created_at', '>=', $startDate);
                }
                if ($endDate) {
                    $q->whereDate('created_at', '<=', $endDate);
                }
            })
            ->whereHas('user', function (Builder $query) {
                $query->where('role_id', RoleStateType::SALER);
            })
                ->get();
            $userName = [];
            foreach($dataUser as $item) {
                $userName[] = $item->user->name;
            }
            $userName = array_unique($userName);
            return response()->json([$saleDailyReports, $userName]);
    }
}
