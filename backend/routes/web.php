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
    Route::get('/login', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\UsersController::class, 'login'])->name('admin.login');
    Route::match(['get', 'post'], '/forgot-password', [App\Http\Controllers\Admin\UsersController::class, 'forgotPassword'])->name('admin.forgot');
    Route::get('/logout', [App\Http\Controllers\Admin\UsersController::class, 'logout'])->name('admin.logout');

    Route::get('/reset-password/{email}/{token}',  [App\Http\Controllers\Admin\UsersController::class, 'getToken'])->name('admin.getToken');
    Route::post('/resetPassword', [App\Http\Controllers\Admin\UsersController::class, 'resetPassword'])->name('admin.resetPassword');
    Route::get('/change-password-complete', [App\Http\Controllers\Admin\UsersController::class, 'change_password_complete'])->name('admin.changePasswordComplete');
    Route::get('/forgot-password-complete', [App\Http\Controllers\Admin\UsersController::class, 'forgot_password_complete'])->name('admin.forgotPasswordComplete');
    Route::get('appointments', [App\Http\Controllers\Admin\AppointmentController::class, 'index'])->name('admin.appointments.index');
    Route::get('getDataAppointments', [App\Http\Controllers\Admin\AppointmentController::class, 'getData'])->name('admin.appointments.getData');
    Route::delete('appointments/{id}', [App\Http\Controllers\Admin\AppointmentController::class, 'destroy'])->name('admin.appointments.delete');
});

Route::middleware([Admin::class])->prefix('/admin')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::prefix('/sale-report-histories')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\SaleDailyReportHistoryController::class, 'index'])->name('admin.saleReportHistory.index');
        Route::post('/getData', [App\Http\Controllers\Admin\SaleDailyReportHistoryController::class, 'getData'])->name('admin.saleReportHistory.getData');
    });
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::get('/users', [\App\Http\Controllers\Admin\UsersController::class, 'list'])->name('admin.user.list');
    Route::get('/user-list', [\App\Http\Controllers\Admin\UsersController::class, 'getUserlist'])->name('admin.user.getUserlist');
    Route::get('/users/{id}/delete', [\App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/register-user', [\App\Http\Controllers\Admin\UsersController::class, 'getRegister'])->name('admin.user.getRegister');
    Route::post('/post-register-user', [\App\Http\Controllers\Admin\UsersController::class, 'postRegister'])->name('admin.user.postRegister');
    Route::get('/user/{id}/edit', [\App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('admin.user.edit');
    Route::post('/user/{id}/post-edit-user', [\App\Http\Controllers\Admin\UsersController::class, 'postEdit'])->name('admin.user.postEdit');
    Route::resource('sales-chart', 'Admin\SalesChartController', [
        'as' => 'admin'
    ]);
    Route::get('/sales-chart/get-chart-data', [\App\Http\Controllers\Admin\UsersController::class, 'show'])->name('admin.user.getChartData');
    Route::get('/report-management', [\App\Http\Controllers\Admin\ReportManagementController::class, 'index'])->name('admin.reportManagement');
    Route::get('/get-data-report-management', [\App\Http\Controllers\Admin\ReportManagementController::class, 'getData'])->name('admin.user.getDataReport');
});

Route::get('/login',[App\Http\Controllers\Sales\UsersController::class, 'index'])->name('login');
Route::post('/login',[App\Http\Controllers\Sales\UsersController::class, 'login'])->name('login');
Route::get('/register',[App\Http\Controllers\Sales\UsersController::class, 'register'])->name('register');
Route::post('/register',[App\Http\Controllers\Sales\UsersController::class, 'registerPost'])->name('register.post');
Route::match(['get', 'post'], '/forgot-password', [App\Http\Controllers\Sales\UsersController::class, 'forgotPassword'])->name('forgot');
Route::get('/logout', [App\Http\Controllers\Sales\UsersController::class, 'logout'])->name('logout');

Route::get('/reset-password/{email}/{token}',  [App\Http\Controllers\Sales\UsersController::class, 'getToken'])->name('getToken');
Route::post('/resetPassword', [App\Http\Controllers\Sales\UsersController::class, 'resetPassword'])->name('resetPassword');
Route::get('/change-password-complete', [App\Http\Controllers\Sales\UsersController::class, 'change_password_complete'])->name('changePasswordComplete');
Route::get('/forgot-password-complete', [App\Http\Controllers\Sales\UsersController::class, 'forgot_password_complete'])->name('forgotPasswordComplete');


Route::middleware([Sale::class])->prefix('/')->group(function () {
    Route::get('/', [App\Http\Controllers\Sales\TopController::class, 'index'])->name('home');
    Route::get('daily-report/create', [App\Http\Controllers\Sales\DailyReportController::class, 'create'])->name('dailyReport.create');
    Route::post('daily-report/create', [App\Http\Controllers\Sales\DailyReportController::class, 'store'])->name('dailyReport.store');
    Route::get('daily-report/complete/{id}', [App\Http\Controllers\Sales\DailyReportController::class, 'complete'])->name('dailyReport.complete');
    Route::get('sales-management', [App\Http\Controllers\Sales\TopController::class, 'salesManagement'])->name('salesManagement');
    Route::get('report-histories', [App\Http\Controllers\Sales\ReportHistoriesController::class, 'index'])->name('sale.reportHistories');
    Route::post('get_data_report_histories', [App\Http\Controllers\Sales\ReportHistoriesController::class, 'reportHistories'])->name('sale.getDataReportHistories');
    Route::get('appointments', [App\Http\Controllers\Sales\AppointmentController::class, 'index'])->name('sales.appointments.index');
    Route::get('appointments/complete/{id}', [App\Http\Controllers\Sales\AppointmentController::class, 'complete'])->name('sales.appointments.complete');
    Route::delete('appointments/{id}', [App\Http\Controllers\Sales\AppointmentController::class, 'destroy'])->name('sales.appointments.delete');
    Route::get('appointments/create', [App\Http\Controllers\Sales\AppointmentController::class, 'create'])->name('sales.appointments.getCreate');
    Route::post('appointments', [App\Http\Controllers\Sales\AppointmentController::class, 'store'])->name('sales.appointments.postCreate');
});
