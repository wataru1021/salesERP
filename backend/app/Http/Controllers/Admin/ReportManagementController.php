<?php

namespace App\Http\Controllers\admin;

use App\Enums\MaxPageSize;
use App\Enums\RoleStateType;
use App\Http\Controllers\Controller;
use App\Models\SaleDailyReport;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Enums\StatusCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class ReportManagementController extends Controller
{
    public function index()
    {
        if (!Auth::guard('admin')->check()) return view('admin.users.login');
        $breadcrumbs = [
           '全営業マンの報告管理'
        ];
        return view('admin/reportmanagement', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function getData(Request $request)
    {
        if (!Auth::guard('admin')->check()) return view('admin.users.login');
        $orderBy = $request->input('column'); //Index
        $orderByDir = $request->input('dir', 'asc');
        $builder = User::query()->leftJoin('sale_daily_reports', function ($join) use ($request) {
            $join->on('users.id', '=', 'sale_daily_reports.user_id')
                ->whereDate('report_date', Carbon::parse($request->input('date')));
        })->where([
            'role_id' => RoleStateType::SALER,
            'company_id' => Auth::guard('admin')->user()->company_id
        ]);
        switch ($orderBy) {
            case 'id':
                $orderBy = 'users.id';
                break;
            case 'has_report':
                $orderBy = 'reportId';
                break;
        }
        $builder->selectRaw('name,
         sale_daily_reports.id as reportId, 
         sale_daily_reports.*, 
         users.id as userId, 
         TRIM( deal_num / ping_pong_num * 100)+0 as opportunity_rate,
         FORMAT(TRIM(acquisitions_num / ping_pong_num *100)+0, 2)  as contract_rate, 
         FORMAT(TRIM(acquisitions_num / sale_time)+0, 2)  as productivity')
            ->orderBy($orderBy, $orderByDir);

        return new DataTableCollectionResource($builder->paginate(MaxPageSize::MAX_PAGE_SIZE, ['*'], 'page', $request->page));
    }
}
