<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index()
    {
        return view('sales.toppage');
    }

    public function salesManagement()
    {
        return view('sales.salesmanagement');
    }
}
