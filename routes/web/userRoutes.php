<?php
    declare(strict_types=1);

    /**
     * Created by Alabi Olawale
     * Date: 05/03/2020
     */

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Redis;

    Route::domain(env('USER_URL_BASE'))->middleware('user')->group(function () {
        Route::get('/', function () {
            return view('user.dashboard.index');
        })->name('user_dashboard');
        Route::get('login', function(){
            return response()->redirectToRoute('user_login');
        });
    });


    Route::post('/user_logout', 'Accounts\Users\Auth\LoginController@logout')->name('user_logout');

    Route::domain('scms.loc')->middleware('guest')->group(function () {
        Route::get('/register', function () {
            return view('auth.user.register');
        })->name('user_register');
        Route::get('/login', 'Accounts\Users\Auth\LoginController@showLoginForm')->name('user_login');
        Route::post('/login', 'Accounts\Users\Auth\LoginController@login')->name('user_login');
    });

