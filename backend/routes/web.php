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
    Route::match(['get', 'post'], '/forgotPassword', [App\Http\Controllers\Admin\UsersController::class, 'forgotPassword'])->name('admin.forgot');
    Route::get('/logout', [App\Http\Controllers\Admin\UsersController::class, 'logout'])->name('admin.logout');
});

Route::middleware([Admin::class])->prefix('/admin')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::get('/users', [\App\Http\Controllers\Admin\UsersController::class, 'list'])->name('admin.user.list');
    Route::get('/userList', [\App\Http\Controllers\Admin\UsersController::class, 'getUserlist'])->name('admin.user.getUserlist');
    Route::get('/users/{id}/delete', [\App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('admin.user.destroy');
});

Route::get('/login', [App\Http\Controllers\Sales\UsersController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\Sales\UsersController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/forgotPassword', [App\Http\Controllers\Sales\UsersController::class, 'forgotPassword'])->name('forgot');

Route::get('/reset-password/{email}/{token}',  [App\Http\Controllers\Sales\UsersController::class, 'getToken'])->name('getToken');
Route::post('/resetPassword', [App\Http\Controllers\Sales\UsersController::class, 'resetPassword'])->name('resetPassword');

Route::get('/change-password-complete', [App\Http\Controllers\Sales\UsersController::class, 'change_password_complete'])->name('changePasswordComplete');
Route::get('/change-password-error', [App\Http\Controllers\Sales\UsersController::class, 'change_password_error'])->name('changePasswordError');

Route::get('/forgot-password-complete', [App\Http\Controllers\Sales\UsersController::class, 'forgot_password_complete'])->name('forgotPasswordComplete');
Route::get('/forgot-password-error', [App\Http\Controllers\Sales\UsersController::class, 'forgot_password_error'])->name('forgotPasswordError');



Route::middleware([Sale::class])->prefix('/')->group(function () {
    Route::get('/', [App\Http\Controllers\Sales\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\Sales\HomeController::class, 'index'])->name('home');
    Route::get('daily-report/create', [App\Http\Controllers\Sales\DailyReportController::class, 'create'])->name('dailyReport.create');
    Route::post('daily-report/create', [App\Http\Controllers\Sales\DailyReportController::class, 'store'])->name('dailyReport.store');
    Route::get('daily-report/complete/{id}', [App\Http\Controllers\Sales\DailyReportController::class, 'complete'])->name('dailyReport.complete');
    Route::get('top', [App\Http\Controllers\Sales\TopController::class, 'index']);
    Route::get('sales_management', [App\Http\Controllers\Sales\TopController::class, 'salesManagement']);
});
