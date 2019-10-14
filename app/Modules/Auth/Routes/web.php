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

Route::group(['prefix' => 'auth'], function () {
    Route::get('/register',['uses'=>'RegisterController@showRegistrationForm'])->name('auth.getRegister');
    Route::post('/register',['uses'=>'RegisterController@register'])->name('auth.postRegister');
    Route::get('/login',['uses'=>'LoginController@showLoginForm'])->name('auth.getLogin');
    Route::get('/logout',['uses'=>'LoginController@logout'])->name('auth.logout');
    Route::post('/login',['uses'=>'LoginController@login'])->name('auth.postLogin');
    Route::get('/password/reset',['uses'=>'ForgotPasswordController@showLinkRequestForm'])->name('auth.password_forgot');

    Route::group(['prefix' => 'user', 'middleware' => ['web', 'auth']], function () {
        Route::get('/', ['uses' => 'UserController@index'])->name('user.list');
        Route::get('/create', ['uses' => 'UserController@create'])->name('user.create');
        Route::get('/edit/{user}', ['uses' => 'UserController@edit'])->name('user.edit');
	    Route::post('/store', ['uses' => 'UserController@store'])->name('user.store');
    });
    
    Route::group(['prefix' => 'role', 'middleware' => ['web', 'auth']], function () {
        Route::get('/', ['uses' => 'RoleController@index'])->name('role.list');
        Route::get('/create', ['uses' => 'RoleController@create'])->name('role.create');
        Route::get('/edit/{role}', ['uses' => 'RoleController@edit'])->name('role.edit');
	    Route::post('/store', ['uses' => 'RoleController@store'])->name('role.store');
    });
    
    Route::group(['prefix' => 'permission', 'middleware' => ['web', 'auth']], function () {
        Route::get('/', ['uses' => 'permissionController@index'])->name('permission.list');
        Route::get('/create', ['uses' => 'permissionController@create'])->name('permission.create');
        Route::get('/edit/{permission}', ['uses' => 'permissionController@edit'])->name('permission.edit');
	    Route::post('/store', ['uses' => 'permissionController@store'])->name('permission.store');
	});
});
