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
Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'AuthController@login');
});

Route::group(['prefix' => 'users','middleware' => ['jwt.verify']], function() {
    Route::post('', 'UsersController@store');
    Route::put('/{id}', 'UsersController@update');
    Route::patch('/{id}', 'UsersController@updateByData');
    Route::get('', 'UsersController@index');
    Route::get('/{id}', 'UsersController@show');
    Route::delete('/{id}', 'UsersController@delete');
});