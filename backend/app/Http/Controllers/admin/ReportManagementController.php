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
        $builder = User::with(['salesDailyReports' => function ($q) use ($request) {
            $q->whereDate('report_date', Carbon::parse($request->input('date')));
        }])->where([
            'role_id' => RoleStateType::SALER,
            'company_id' => Auth::guard('admin')->user()->company_id
        ]);/*->where('salesDailyReports', function($q) use ($request){
            $q->whereDate('report_date', Carbon::parse($request->input('date')));
        });*/
        switch ($orderByDir) {
            case 'asc':
                $builder->orderBy($orderBy);
                break;
            case 'desc':
                $builder->orderByDesc($orderBy);
                break;
        }
        $a = new DataTableCollectionResource($builder->paginate(MaxPageSize::MAX_PAGE_SIZE, ['*'], 'page', $request->page));
        return new DataTableCollectionResource($builder->paginate(MaxPageSize::MAX_PAGE_SIZE, ['*'], 'page', $request->page));
        $userBuilder = SaleDailyReport::whereDate('report_date', Carbon::parse($request->input('date')))->with('user');
        switch ($orderByDir) {
            case 'asc':
                $userBuilder->orderBy($orderBy);
                break;
            case 'desc':
                $userBuilder->orderByDesc($orderBy);
                break;
        }
        return new DataTableCollectionResource($userBuilder->paginate(MaxPageSize::MAX_PAGE_SIZE, ['*'], 'page', $request->page));
    }
}
