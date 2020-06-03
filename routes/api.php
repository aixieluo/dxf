<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api']], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login')->name('login');
        Route::get('me', 'AuthController@me')->name('me');
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::post('refresh', 'AuthController@refresh')->name('refresh');
    });
    Route::get('/positions', 'AdminController@positions')->name('positions');
    Route::group(['prefix'=> 'users'], function () {
        Route::get('/', 'AdminController@users')->name('users');
        Route::get('/{id}', 'AdminController@user')->name('user');
        Route::post('/create', 'AdminController@createUser')->name('users.create');
        Route::post('{id}/update', 'AdminController@updateUser')->name('users.update');
        Route::post('{id}/delete', 'AdminController@deleteUser')->name('users.delete');
    });
});
