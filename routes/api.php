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
Route::post('itemsDungeonsDrops/delete/{id}', 'ItemsDungeonsDropsController@delete');
Route::post('itemsDungeonsDrops/update/{id}', 'ItemsDungeonsDropsController@update');
Route::post('itemsDungeonsDrops/store', 'ItemsDungeonsDropsController@store');
Route::get('itemsDungeonsDrops/getById/{id}', 'ItemsDungeonsDropsController@getById');

Route::resource('items', 'ItemsController');
Route::post('items/delete/{id}', 'ItemsController@delete');
Route::post('items/update/{id}', 'ItemsController@update');
Route::post('items/store', 'ItemsController@store');
Route::get('items/getById/{id}', 'ItemsController@getById');

Route::resource('friends', 'FriendsController');
Route::post('friends/delete/{id}', 'FriendsController@delete');
Route::post('friends/update/{id}', 'FriendsController@update');
Route::post('friends/store', 'FriendsController@store');
Route::get('friends/getById/{id}', 'FriendsController@getById');

Route::resource('foodUsers', 'FoodUsersController');
Route::post('foodUsers/delete/{id}', 'FoodUsersController@delete');
Route::post('foodUsers/update/{id}', 'FoodUsersController@update');
Route::post('foodUsers/store', 'FoodUsersController@store');
Route::get('foodUsers/getById/{id}', 'FoodUsersController@getById');

Route::resource('foodCatalog', 'FoodCatalogController');
Route::post('foodCatalog/delete/{id}', 'FoodCatalogController@delete');
Route::post('foodCatalog/update/{id}', 'FoodCatalogController@update');
Route::post('foodCatalog/store', 'FoodCatalogController@store');
Route::get('foodCatalog/getById/{id}', 'FoodCatalogController@getById');

Route::resource('dungeonsUsers', 'DungeonsUsersController');
Route::post('dungeonsUsers/delete/{id}', 'DungeonsUsersController@delete');
Route::post('dungeonsUsers/update/{id}', 'DungeonsUsersController@update');
Route::post('dungeonsUsers/store', 'DungeonsUsersController@store');
Route::get('dungeonsUsers/getById/{id}', 'DungeonsUsersController@getById');

Route::resource('dungeons', 'DungeonsController');
Route::post('dungeons/delete/{id}', 'DungeonsController@delete');
Route::post('dungeons/update/{id}', 'DungeonsController@update');
Route::post('dungeons/store', 'DungeonsController@store');
Route::get('dungeons/getById/{id}', 'DungeonsController@getById');

Route::resource('dungeons', 'DuelsUsersController');
Route::post('dungeons/delete/{id}', 'DuelsUsersController@delete');
Route::post('dungeons/update/{id}', 'DuelsUsersController@update');
Route::post('dungeons/store', 'DuelsUsersController@store');
Route::get('dungeons/getById/{id}', 'DuelsUsersController@getById');
