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

Route::group([
    'prefix' => '/admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
], function () {
    // Route::get('/login', 'UsersController@index')->name('login');
    // Route::post('/login', 'UsersController@login')->name('login');
    Route::get('/login', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('login');

});
