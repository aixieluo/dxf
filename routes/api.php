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
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', 'OrderController@index');
        Route::get('/{id}', 'OrderController@order');
        Route::post('/', 'OrderController@create');
        Route::post('/{id}/update', 'OrderController@update');
        Route::post('/{id}/delete', 'OrderController@delete');
        Route::post('/{id}/confirm', 'OrderController@confirm');
        Route::get('/{id}/drawing/download', 'OrderController@downloadDrawing');
        Route::get('/drawing/zip/download', 'OrderController@downloadDrawingZip');
        Route::get('/{id}/design/{d_id}', 'OrderController@orderDesign');
        Route::post('/{id}/design/{d_id}/update', 'OrderController@updateOrderDesign');
        Route::post('/{id}/design/{d_id}/od/{od_id}/delete', 'OrderController@delOrderDesign');
    });
    Route::group(['prefix' => 'report'], function () {
        Route::get('material', 'ReportController@material');
        Route::get('material/excel', 'ReportController@exportMaterial');
        Route::get('user', 'ReportController@user');
        Route::get('user/excel', 'ReportController@exportUser');
    });
    Route::group(['prefix' => 'sofa'], function () {
        Route::get('/', 'SofaController@index');
        Route::get('/list', 'SofaController@sofas');
        Route::get('/{id}', 'SofaController@sofa');
        Route::post('/', 'SofaController@create');
        Route::post('/{id}', 'SofaController@update');
        Route::post('/{id}/delete', 'SofaController@delete');
        Route::group(['prefix' => '{id}/items'], function () {
            Route::get('/', 'SofaController@items');
            Route::get('/{itemId}', 'SofaController@item');
            Route::post('/', 'SofaController@createItem');
            Route::post('/{itemId}', 'SofaController@updateItem');
            Route::post('/{itemId}/delete', 'SofaController@deleteItem');
        });
    });
    Route::post('upload', 'UploadController@upload');
    Route::get('designs', 'SofaController@designs');
});
