<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $breadcrumbs = [
            [
                'name' => '管理者一覧',
                'url' => route('login')

            ], '請求書・領収書発行（株式会社）'
        ];
        return view('admin.homepage', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
