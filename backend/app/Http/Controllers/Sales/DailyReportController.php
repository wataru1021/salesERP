<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    public function create()
    {
        return view('sales.DailyReports.create');
    }
}
