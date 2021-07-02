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

use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    Route::get('/login',[App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.login');
    Route::post('/login',[App\Http\Controllers\Admin\UsersController::class, 'login'])->name('admin.login');
    Route::match(['get', 'post'], '/forgotPassword', [App\Http\Controllers\Admin\UsersController::class, 'forgotPassword'])->name('admin.forgot');
    Route::get('/logout', [App\Http\Controllers\Admin\UsersController::class, 'logout'])->name('admin.logout');
    Route::get('/',[App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
});

Route::prefix('/')->group(function () {
    Route::get('/login',[App\Http\Controllers\Sales\UsersController::class, 'index'])->name('login');
    Route::post('/login',[App\Http\Controllers\Sales\UsersController::class, 'login'])->name('login');

    Route::get('/',[App\Http\Controllers\Sales\HomeController::class, 'index'])->name('home');
});