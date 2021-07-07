<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesChartController extends Controller
{

    public function index(Request $request) {
        if (!Auth::guard('admin')->check()) return view('admin.users.login');
        return view('admin.saleschart.index');
    }
}
