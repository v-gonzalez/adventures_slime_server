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
Route::get('user/getAll', 'UsersController@getAll');
Route::post('user/update/{id}', 'UsersController@update');
Route::post('user/store', 'UsersController@store');
Route::get('user/getById/{id}', 'UsersController@getById');
Route::post('user/login', 'UsersController@login');
Route::get('user/logout', 'UsersController@logout');
