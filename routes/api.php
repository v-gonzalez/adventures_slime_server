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
Route::get('user/getByUserIds/{ids}', 'UsersController@getByUserIds');
Route::post('user/login', 'UsersController@login');
Route::get('user/logout/{session}/{id}', 'UsersController@logout');

Route::resource('usersProfiles', 'UsersProfilesController');
Route::post('usersProfiles/delete/{id}', 'UsersProfilesController@delete');
Route::post('usersProfiles/update/{id}', 'UsersProfilesController@update');
Route::post('usersProfiles/updateStats', 'UsersProfilesController@updateStats');
Route::post('usersProfiles/store', 'UsersProfilesController@store');
Route::post('usersProfiles/getByUserId/{id}', 'UsersProfilesController@getByUserId');
Route::get('usersProfiles/getByUserIds/{ids}', 'UsersProfilesController@getByUserIds');
Route::post('usersProfiles/create_character/{id}', 'UsersProfilesController@create_character');

Route::resource('sleepingUsers', 'SleepingUsersController');
Route::post('sleepingUsers/delete/{session}/{id}', 'SleepingUsersController@delete');
Route::post('sleepingUsers/update/{session}/{id}', 'SleepingUsersController@update');
Route::post('sleepingUsers/store', 'SleepingUsersController@store');
Route::get('sleepingUsers/getById/{id}', 'SleepingUsersController@getById');
Route::post('sleepingUsers/sleepUser', 'SleepingUsersController@sleepUser');
Route::post('sleepingUsers/wakeUpUser', 'SleepingUsersController@wakeUpUser');
Route::get('sleepingUsers/getByUserId/{session}/{id}', 'SleepingUsersController@getByUserId');
Route::get('sleepingUsers/getByUserIds/{session}/{ids}', 'SleepingUsersController@getByUserIds');

Route::resource('itemsUsers', 'ItemsUsersController');
Route::post('itemsUsers/setBroken/{id}', 'ItemsUsersController@setBroken');
Route::post('itemsUsers/update/{id}', 'ItemsUsersController@update');
Route::post('itemsUsers/store', 'ItemsUsersController@store');
Route::get('itemsUsers/getById/{ids}', 'ItemsUsersController@getById');
Route::get('itemsUsers/getByUserId/{id}', 'ItemsUsersController@getByUserId');
Route::get('itemsUsers/getByUserIds/{ids}', 'ItemsUsersController@getByUserIds');
Route::post('itemsUsers/destroy/{id}', 'ItemsUsersController@destroy');

Route::resource('itemsDungeonsDrops', 'ItemsDungeonsDropsController');
Route::post('itemsDungeonsDrops/delete/{id}', 'ItemsDungeonsDropsController@delete');
Route::post('itemsDungeonsDrops/update/{id}', 'ItemsDungeonsDropsController@update');
Route::post('itemsDungeonsDrops/store', 'ItemsDungeonsDropsController@store');
Route::get('itemsDungeonsDrops/getById/{id}', 'ItemsDungeonsDropsController@getById');
Route::get('itemsDungeonsDrops/getItemsByDungeon/{id}', 'ItemsDungeonsDropsController@getItemsByDungeon');
Route::get('itemsDungeonsDrops/getItemsByDungeonsIds/{ids}', 'ItemsDungeonsDropsController@getItemsByDungeonsIds');

Route::resource('items', 'ItemsController');
Route::post('items/delete/{id}', 'ItemsController@delete');
Route::post('items/update/{id}', 'ItemsController@update');
Route::post('items/store', 'ItemsController@store');
Route::get('items/getById/{id}', 'ItemsController@getById');
Route::get('items/getAll/{id}', 'ItemsController@getAll');
Route::get('items/getByName/{name}', 'ItemsController@getByName');
Route::get('items/getByType/{type}', 'ItemsController@getByType');

Route::resource('friends', 'FriendsController');
Route::post('friends/delete/{id}', 'FriendsController@delete');
Route::post('friends/update/{id}', 'FriendsController@update');
Route::post('friends/store', 'FriendsController@store');
Route::get('friends/getById/{id}', 'FriendsController@getById');
Route::get('friends/getAllFriendsByUserId/{id}', 'FriendsController@getAllFriendsByUserId');
Route::get('friends/getAcceptedFriendsByUserId/{id}', 'FriendsController@getAcceptedFriendsByUserId');
Route::get('friends/getPendingFriendsByUserId/{id}', 'FriendsController@getPendingFriendsByUserId');
Route::get('friends/getDeclinedFriendsByUserId/{id}', 'FriendsController@getDeclinedFriendsByUserId');
Route::post('friends/removeFriend/{id}', 'FriendsController@removeFriend');

Route::resource('foodUsers', 'FoodUsersController');
Route::post('foodUsers/delete/{id}', 'FoodUsersController@delete');
Route::post('foodUsers/update/{id}', 'FoodUsersController@update');
Route::post('foodUsers/store', 'FoodUsersController@store');
Route::get('foodUsers/getById/{id}', 'FoodUsersController@getById');
Route::get('foodUsers/getByUserId/{id}', 'FoodUsersController@getByUserId');
Route::get('foodUsers/setExpired/{id}', 'FoodUsersController@setExpired');
Route::get('foodUsers/setBad/{id}', 'FoodUsersController@setBad');

Route::resource('foodCatalog', 'FoodCatalogController');
Route::post('foodCatalog/delete/{id}', 'FoodCatalogController@delete');
Route::post('foodCatalog/update/{id}', 'FoodCatalogController@update');
Route::post('foodCatalog/store', 'FoodCatalogController@store');
Route::get('foodCatalog/getById/{id}', 'FoodCatalogController@getById');
Route::get('foodCatalog/getAll', 'FoodCatalogController@getAll');
Route::get('foodCatalog/getByName/{name}', 'FoodCatalogController@getByName');

Route::resource('dungeonsUsers', 'DungeonsUsersController');
Route::post('dungeonsUsers/delete/{id}', 'DungeonsUsersController@delete');
Route::post('dungeonsUsers/update/{id}', 'DungeonsUsersController@update');
Route::post('dungeonsUsers/store', 'DungeonsUsersController@store');
Route::get('dungeonsUsers/getById/{id}', 'DungeonsUsersController@getById');
Route::get('dungeonsUsers/getAllDungeonsByUserId/{id}', 'DungeonsUsersController@getAllDungeonsByUserId');
Route::post('dungeonsUsers/getActiveDungeonByUserId', 'DungeonsUsersController@getActiveDungeonByUserId');
Route::get('dungeonsUsers/getLostDungeonsByUserId/{id}', 'DungeonsUsersController@getLostDungeonsByUserId');
Route::get('dungeonsUsers/getCompleteDungeonsByUserId/{id}', 'DungeonsUsersController@getCompleteDungeonsByUserId');
Route::post('dungeonsUsers/setCompleted/{id}', 'DungeonsUsersController@setCompleted');
Route::post('dungeonsUsers/setLost/{id}', 'DungeonsUsersController@setLost');

Route::resource('dungeons', 'DungeonsController');
Route::post('dungeons/delete/{id}', 'DungeonsController@delete');
Route::post('dungeons/update/{id}', 'DungeonsController@update');
Route::post('dungeons/store', 'DungeonsController@store');
Route::get('dungeons/getById/{id}', 'DungeonsController@getById');
Route::post('dungeons/getAll/{id}', 'DungeonsController@getAll');
Route::get('dungeons/getByName/{name}', 'DungeonsController@getByName');
Route::get('dungeons/getByStatus/{status}', 'DungeonsController@getByStatus');

Route::resource('duelsUsers', 'DuelsUsersController');
Route::post('duelsUsers/delete/{id}', 'DuelsUsersController@delete');
Route::post('duelsUsers/update/{id}', 'DuelsUsersController@update');
Route::post('duelsUsers/store', 'DuelsUsersController@store');
Route::get('duelsUsers/getById/{id}', 'DuelsUsersController@getById');
Route::get('duelsUsers/getAllDuelsByUserId/{id}', 'DuelsUsersController@getAllDuelsByUserId');
Route::get('duelsUsers/getWonDuelsByUserId/{id}', 'DuelsUsersController@getWonDuelsByUserId');
Route::post('duelsUsers/setCompleted/{id}', 'DuelsUsersController@setCompleted');
Route::post('duelsUsers/setDeclined/{id}', 'DuelsUsersController@setDeclined');