<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SaleDailyReport;
use Carbon\Carbon;
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
        // $startDate = Carbon::now();
        $endDate = $request->endDate;
        // return response()->json($request->startDate);
        $saleDailyReports = SaleDailyReport::whereDate('created_at', '>=', $startDate)
            ->selectRaw('sum(ping_pong_num) as ping_pong_num')
            ->selectRaw('sum(meet_num) as meet_num')
            ->selectRaw('sum(deal_num) as deal_num')
            ->selectRaw('sum(acquisitions_num) as acquisitions_num')
            ->selectRaw('sum(sale_time) as sale_time')
            ->get();
            return response()->json($saleDailyReports);
    }
}
