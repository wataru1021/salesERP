<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportManagementController extends Controller
{
    public function report(Request $request)
    {
        return view('admin/reportmanagement');
    }
}
