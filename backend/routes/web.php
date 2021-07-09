<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Middleware\Admin;
use App\Http\Middleware\Sale;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;


Route::prefix('/admin')->group(function () {
    Route::get('/login',[App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.login');
    Route::post('/login',[App\Http\Controllers\Admin\UsersController::class, 'login'])->name('admin.login');
    Route::match(['get', 'post'], '/forgotPassword', [App\Http\Controllers\Admin\UsersController::class, 'forgotPassword'])->name('admin.forgot');
    Route::get('/logout', [App\Http\Controllers\Admin\UsersController::class, 'logout'])->name('admin.logout');
});

Route::middleware([Admin::class])->prefix('/admin')->group(function () {
    Route::get('/',[App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::get('/users', [\App\Http\Controllers\Admin\UsersController::class, 'list'])->name('admin.user.list');
    Route::get('/user-list', [\App\Http\Controllers\Admin\UsersController::class, 'getUserlist'])->name('admin.user.getUserlist');
    Route::get('/users/{id}/delete', [\App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('admin.user.destroy');
    Route::resource('sales-chart', 'Admin\SalesChartController', [
        'as' => 'admin'
    ]);
    Route::get('/sales-chart/get-chart-data', [\App\Http\Controllers\Admin\UsersController::class, 'show'])->name('admin.user.getChartData');
    Route::get('/report-management', [\App\Http\Controllers\Admin\ReportManagementController::class, 'index'])->name('admin.reportManagement');
    Route::get('/get-data-report-management', [\App\Http\Controllers\Admin\ReportManagementController::class, 'getData'])->name('admin.user.getDataReport');
});

Route::get('/login',[App\Http\Controllers\Sales\UsersController::class, 'index'])->name('login');
Route::post('/login',[App\Http\Controllers\Sales\UsersController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/forgotPassword', [App\Http\Controllers\Sales\UsersController::class, 'forgotPassword'])->name('forgot');

Route::middleware([Sale::class])->prefix('/')->group(function () {
    Route::get('/',[App\Http\Controllers\Sales\HomeController::class, 'index'])->name('home');
    Route::get('daily-report/create',[App\Http\Controllers\Sales\DailyReportController::class, 'create'])->name('dailyReport.create');
    Route::post('daily-report/create',[App\Http\Controllers\Sales\DailyReportController::class, 'store'])->name('dailyReport.store');
    Route::get('daily-report/complete/{id}',[App\Http\Controllers\Sales\DailyReportController::class, 'complete'])->name('dailyReport.complete');
    Route::get('top', [App\Http\Controllers\Sales\TopController::class, 'index']);
    Route::get('sales_management', [App\Http\Controllers\Sales\TopController::class, 'salesManagement']);
});
