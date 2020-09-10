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

Route::get('/login', 'LoginController@login')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/', function () {
    return redirect('/panel/');
});

Auth::routes();

Route::prefix('panel')->group(function () {// ->middleware('auth')
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/user-admin', 'UserActions\UserController@index')->name('adminUser');
    Route::post('/user-admin/data', 'UserActions\UserController@getUsersData')->name('adminUserData');
    Route::get('/user-admin/created/{id?}', 'UserActions\UserController@getUserCreated')->name('adminUserCreated');
});
