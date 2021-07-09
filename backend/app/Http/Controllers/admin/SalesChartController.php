<?php
namespace App\Http\Controllers\Admin;


use App\Enums\RoleStateType;
use App\Enums\StatusCode;
use App\Enums\TimeLine;
use App\Http\Controllers\Controller;
use App\Models\SaleDailyReport;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class SalesChartController extends Controller
{

    public function index(Request $request) {
        if (!Auth::guard('admin')->check()) return view('admin.users.login');
        $breadcrumbs = [
            [
                'name' => '全営業マンの報告管理',
                'url' => route('login')

            ], '指標毎の営業マン成績'
        ];
        return view('admin.saleschart.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function show(Request $request) {

        if (!Auth::guard('admin')->check()) return response()->json([], StatusCode::FORBIDDEN);
        $startFilterDay = $endFilterDay = Carbon::now();
        if ($request->timeLine != TimeLine::HandMadeTimeLine) {
            switch ($request->timeLine)
            {
                case TimeLine::Today:
                    $startFilterDay = $endFilterDay = Carbon::now();
                    break;
                case TimeLine::Yesterday:
                    $startFilterDay = $endFilterDay = Carbon::yesterday();
                    break;
                case TimeLine::Last7Days:
                    $startFilterDay = Carbon::now()->subDays(7);
                    $endFilterDay = Carbon::now();
                    break;
                case TimeLine::Last30Days:
                    $startFilterDay = Carbon::now()->subDays(30);
                    $endFilterDay = Carbon::now();
                    break;
            }
        }
        else {
            $startFilterDay =  new Carbon($request->startDate);
            $endFilterDay = new Carbon($request->endDate);
        }

        $sdrs = SaleDailyReport::with('user')
                ->whereHas('user', function($q) {
                    $q->where('company_id',  Auth::guard('admin')->user()->company_id);
                })
                ->whereBetween('report_date', [$startFilterDay->format('Y-m-d 00:00:00'), $endFilterDay->format('Y-m-d 23:59:59')])
                ->join('users', 'sale_daily_reports.user_id', '=', 'users.id')
                ->groupBy('user_id')
                ->selectRaw('user_id, sum(acquisitions_num) as acquisitions_num, sum(ping_pong_num) as ping_pong_num, sum(sale_time) / 24 as sale_time, sum(acquisitions_num) / sum(ping_pong_num) * 100 as contract_rate, sum(acquisitions_num) / sum(sale_time)  as productivity')
                ->get();

        return response()->json([
            'data' => [
                'arr' => $sdrs->toArray(),
                'names' => array_map(function ($obj) {
                    return $obj['name'];
                }, User::query()->whereNotIn('id', array_map(function ($o) {
                    return $o['user_id'];
                }, $sdrs->toArray()))->where(['role_id' => RoleStateType::SALER])->where('company_id',  Auth::guard('admin')->user()->company_id)->get()->toArray()),
                'timeLineText' => $startFilterDay->year . '年' . $startFilterDay->month . '月' . $startFilterDay->day . '日'
                    . '～' .
                    $endFilterDay->year . '年' . $endFilterDay->month . '月' . $endFilterDay->day . '日'
            ]
        ], StatusCode::OK);
    }
}