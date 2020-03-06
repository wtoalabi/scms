<?php
    declare(strict_types=1);
  /**
   * Created by Alabi Olawale
   * Date: 05/03/2020
   */

    use Illuminate\Support\Facades\Route;


    Route::domain('admin.scms.loc')->middleware('web')->group(function () {
        Route::get('/', function(){
            return view('admin.dashboard.index');
        });
    });

    Route::domain('admin.scms.loc')->middleware('web')->group(function () {
        Route::get('/login', function(){
            return view('admin.landing.login');
        })->name('admin_login');
    });

