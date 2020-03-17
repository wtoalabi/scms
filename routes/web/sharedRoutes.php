<?php
  declare(strict_types=1);

    use Illuminate\Support\Facades\Route;

    Route::domain('scms.loc')->middleware('shared')->group(function () {
        Route::get('/', function(){
            return view('shared.index');
        })->name('landing');

        Route::get('/404', function(){
            return view('shared.404');
        })->name('404');

        //Route::post('/admin_logout','Accounts\Admins\Auth\LoginController@logout')->name('admin_logout');
    });

    Route::domain('{route}.scms.loc')->middleware('admin_user')->group(function () {
        Route::get('loadMetaData','Generic\MetaDataController@index');
        Route::post('contacts','Contacts\ContactsController@index');
    });
