<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware'=>['web', 'auth']],function()
{
    Route::get('/',function(){
        return redirect('/dashboard');
    });
});

Route::group(['prefix' => 'dashboard', 'middleware'=>['web', 'auth']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/change_local', 'DashboardController@changeLanguage');
});
