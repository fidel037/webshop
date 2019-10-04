<?php

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

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user/{id?}', 'UserController@get');
    Route::patch('password', 'UserController@changePassword');
    Route::post('items', 'ItemController@postSearch');
    Route::post('pay', 'OrderController@pay');
    Route::post('basket', 'OrderController@postItem');
    Route::post('orders', 'OrderController@orderHistory');
    Route::get('basket', 'OrderController@getOrder');
    Route::delete('basket/{id}', 'OrderController@removeItem');
});
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
