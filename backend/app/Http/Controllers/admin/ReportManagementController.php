<?php

namespace App\Http\Controllers\admin;

use App\Enums\MaxPageSize;
use App\Http\Controllers\Controller;
use App\Models\SaleDailyReport;
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
