<?php

/*
|--------------------------------------------------------------------------
| Rutas de la pagina
|--------------------------------------------------------------------------s
*/

use Illuminate\Support\Facades\Route;

Route::get('/login', 'LoginController@login')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/', function () {
    return redirect('/panel/');
});

Auth::routes();

Route::prefix('panel')->middleware('auth')->group(function () { // ->middleware('auth')
    Route::get('/', 'HomeController@index')->name('home');

    //menu routes
    Route::get('/user-admin', 'UserActions\UserController@index')->name('adminUser');
    Route::get('/christian-training-school', 'EFCActions\EFCController@index')->name('christianTrainingSchool');

    //rutas de acciones
    Route::post('/user-admin/data', 'UserActions\UserController@getUsersData')->name('adminUserData');
    Route::get('/user-admin/created/{id?}', 'UserActions\UserController@getUserCreated')->name('adminUserCreated');
    Route::post('/user-admin/save', 'UserActions\UserController@userSave')->name('adminUserSave');
    Route::post('/user-admin/remove', 'UserActions\UserController@removeUser')->name('adminUserRemove');
});
