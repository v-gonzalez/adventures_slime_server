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

Route::resource('usersProfiles', 'UsersProfilesController');
Route::post('usersProfiles/delete/{id}', 'UsersProfilesController@delete');
Route::post('usersProfiles/update/{id}', 'UsersProfilesController@update');
Route::post('usersProfiles/store', 'UsersProfilesController@store');
Route::get('usersProfiles/getById/{id}', 'UsersProfilesController@getById');

Route::resource('sleepingUsers', 'SleepingUsersController');
Route::post('sleepingUsers/delete/{id}', 'SleepingUsersController@delete');
Route::post('sleepingUsers/update/{id}', 'SleepingUsersController@update');
Route::post('sleepingUsers/store', 'SleepingUsersController@store');
Route::get('sleepingUsers/getById/{id}', 'SleepingUsersController@getById');

Route::resource('itemsUsers', 'ItemsUsersController');
Route::post('itemsUsers/setbroken/{id}', 'ItemsUsersController@setbroken');
Route::post('itemsUsers/update/{id}', 'ItemsUsersController@update');
Route::post('itemsUsers/store', 'ItemsUsersController@store');
Route::get('itemsUsers/getById/{id}', 'ItemsUsersController@getById');


Route::resource('itemsDungeonsDrops', 'ItemsDungeonsDropsController');
Route::post('itemsDungeonsDrops/delete/{id}', 'ItemsDungeonsDropsController@setbroken');
Route::post('itemsDungeonsDrops/update/{id}', 'ItemsDungeonsDropsController@update');
Route::post('itemsDungeonsDrops/store', 'ItemsDungeonsDropsController@store');
Route::get('itemsDungeonsDrops/getById/{id}', 'ItemsDungeonsDropsController@getById');