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
});

Route::get('/login', [App\Http\Controllers\Sales\UsersController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\Sales\UsersController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/forgotPassword', [App\Http\Controllers\Sales\UsersController::class, 'forgotPassword'])->name('forgot');

Route::post('/setToken', [App\Http\Controllers\Sales\UsersController::class, 'setToken'])->name('setToken');
Route::get('/getToken/{token}',  [App\Http\Controllers\Sales\UsersController::class, 'getToken'])->name('getToken');
Route::post('/resetPassword', [App\Http\Controllers\Sales\UsersController::class, 'resetPassword'])->name('resetPassword');
Route::get('/successPassword', [App\Http\Controllers\Sales\UsersController::class, 'successPassword'])->name('success');


Route::middleware([Sale::class])->prefix('/')->group(function () {
    Route::get('/', [App\Http\Controllers\Sales\HomeController::class, 'index'])->name('home');
});
