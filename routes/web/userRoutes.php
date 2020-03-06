<?php
    declare(strict_types=1);

    /**
     * Created by Alabi Olawale
     * Date: 05/03/2020
     */

    use Illuminate\Support\Facades\Route;

    Route::domain('account.scms.loc')->middleware('web')->group(function () {
        Route::get('/', function () {
            return view('user.dashboard.index');
        })->name('user_dashboard');
    });

    Route::post('/user_logout', 'Accounts\Users\Auth\LoginController@logout')->name('user_logout');

    Route::domain('scms.loc')->middleware('guest')->group(function () {
        Route::get('/register', function () {
            return view('auth.user.register');
        })->name('user_register');
        Route::get('/login', 'Accounts\Users\Auth\LoginController@showLoginForm')->name('user_login');
        Route::post('/login', 'Accounts\Users\Auth\LoginController@login')->name('user_login');
    });

