<?php

/*
|--------------------------------------------------------------------------
| Rutas de la pagina
|--------------------------------------------------------------------------s
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', 'LoginController@login')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/', function () {
    return redirect('/panel/');
});

Auth::routes();

Route::prefix('panel')->middleware('auth')->group(function () { // ->middleware('auth')
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/christian-training-school', 'EFCActions\EFCController@index')->name('christianTrainingSchool');
    Route::get('/christian-training-school/new/{id?}', 'EFCActions\EFCController@getSchoolCreated')->name('christianTrainingSchoolCreated');
});

Route::prefix('admin')->middleware('auth')->group(function () { // ->middleware('auth')
    //menu routes
    Route::get('/user-admin', 'UserActions\UserController@index')->name('adminUser');

    //rutas de acciones Administración
    Route::post('/user-admin/data', 'UserActions\UserController@getUsersData')->name('adminUserData');
    Route::get('/user-admin/created/{id?}', 'UserActions\UserController@getUserCreated')->name('adminUserCreated');
    Route::post('/user-admin/save', 'UserActions\UserController@userSave')->name('adminUserSave');
    Route::post('/user-admin/remove', 'UserActions\UserController@removeUser')->name('adminUserRemove');
});
