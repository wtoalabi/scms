<?php

use Illuminate\Support\Facades\Route;

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

    Route::domain('admin.scms.loc')->middleware('web')->group(function () {
        Route::get('/', function(){
            return view('admin.dashboard.index');
        });
    });

    Route::domain('account.scms.loc')->middleware('web')->group(function () {
        Route::get('/', function(){
            return view('account.dashboard.index');
        });
    });
