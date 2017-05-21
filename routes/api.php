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

Route::resource('users', 'UsersController');
Route::get('users/getAll', 'UsersController@getAll');
Route::post('users/update/{id}', 'UsersController@update');
Route::get('users/getById/{id}', 'UsersController@getById');
