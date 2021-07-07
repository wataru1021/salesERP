<?php
namespace App\Http\Controllers\Admin;


use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Models\SaleDailyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $sdr = SaleDailyReport::with('users')->whereDate('report_date', '=', Carbon::today()->toDateString())->get();
        $a = 0;

    }
}
