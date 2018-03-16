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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/clients','ClientController@index')->middleware('auth:api');
Route::get('/client/{client}','ClientController@get')->middleware('auth:api');
Route::put('/client/{client}','ClientController@update')->middleware('auth:api','only.user');
Route::delete('/client/{client}','ClientController@delete')->middleware('auth:api','only.user');
Route::post('/clients','ClientController@store')->middleware('auth:api','only.user');

Route::get('/states','StateController@index')->middleware('auth:api');
Route::get('/state/{state}','StateController@get')->middleware('auth:api');
Route::delete('/state/{state}','StateController@delete')->middleware('auth:api','only.user');

Route::get('/cities','CityController@index')->middleware('auth:api');
Route::delete('/city/{city}','StateController@delete')->middleware('auth:api','only.user');

Route::get('/addresses','AddressController@index')->middleware('auth:api');
Route::post('/addresses','AddressController@store')->middleware('auth:api','only.user');
Route::get('/address/{address}','AddressController@get')->middleware('auth:api');
Route::delete('/address/{address}','AddressController@delete')->middleware('auth:api','only.user');
Route::put('/address/{address}','AddressController@update')->middleware('auth:api','only.user');

Route::get('/farms','FarmController@index')->middleware('auth:api');
Route::get('/farm/{farm}','FarmController@get')->middleware('auth:api');
Route::put('/farm/{farm}','FarmController@update')->middleware('auth:api','only.user');
Route::delete('/farm/{farm}','FarmController@delete')->middleware('auth:api','only.user');
Route::post('/farms','FarmController@store')->middleware('auth:api','only.user');

Route::get('/cultures','CultureController@index')->middleware('auth:api');
Route::post('/cultures','CultureController@store')->middleware('auth:api','only.user');
Route::delete('/culture/{culture}','CultureController@delete')->middleware('auth:api','only.user');
Route::get('/culture/{culture}','CultureController@get')->middleware('auth:api');

Route::get('/fields','FieldController@index')->middleware('auth:api');
Route::get('/field/{field}','FieldController@get')->middleware('auth:api');
Route::put('/field/{field}','FieldController@update')->middleware('auth:api','only.user');
Route::delete('/field/{field}','FieldController@delete')->middleware('auth:api','only.user');
Route::post('/fields','FieldController@store')->middleware('auth:api','only.user');

Route::get('/crops','CropController@index')->middleware('auth:api');
Route::get('/crop/{crop}','CropController@get')->middleware('auth:api');
Route::put('/crop/{crop}','CropController@update')->middleware('auth:api','only.user');
Route::delete('/crop/{crop}','CropController@delete')->middleware('auth:api','only.user');
Route::post('/crops','CropController@store')->middleware('auth:api','only.user');
Route::post('/crop/{crop}/sold_sack','CropController@register_sack')->middleware('auth:api');

Route::get('/activity_types','ActivityTypeController@index')->middleware('auth:api');
Route::get('/activity_type/{activity_type}','ActivityTypeController@get')->middleware('auth:api');
Route::put('/activity_type/{activity_type}','ActivityTypeController@update')->middleware('auth:api','only.user');
Route::delete('/activity_type/{activity_type}','ActivityTypeController@delete')->middleware('auth:api','only.user');
Route::post('/activity_types','ActivityTypeController@store')->middleware('auth:api','only.user');

Route::get('/activities','ActivityController@index')->middleware('auth:api');
Route::get('/activity/{activity}','ActivityController@get')->middleware('auth:api');
Route::put('/activity/{activity}','ActivityController@update')->middleware('auth:api','only.user');
Route::delete('/activity/{activity}','ActivityController@delete')->middleware('auth:api','only.user');
Route::post('/activities','ActivityController@store')->middleware('auth:api','only.user');

Route::get('/unities','UnityController@index')->middleware('auth:api');
Route::get('/unity/{unity}','UnityController@get')->middleware('auth:api');
Route::put('/unity/{unity}','UnityController@update')->middleware('auth:api','only.user');
Route::delete('/unity/{unity}','UnityController@delete')->middleware('auth:api','only.user');
Route::post('/unities','UnityController@store')->middleware('auth:api','only.user');

Route::get('/users','UserController@index')->middleware('auth:api','only.master');
Route::post('/user/giveAccess','UserController@access')->middleware('auth:api','only.master');
Route::get('/user/{user}','UserController@get')->middleware('auth:api','only.master');
Route::put('/user/{user}','UserController@update')->middleware('auth:api','only.master');
Route::delete('/user/{user}','UserController@delete')->middleware('auth:api','only.master');
Route::post('/users','UserController@store')->middleware('auth:api','only.master');
Route::get('/current_user','UserController@actualUser')->middleware('auth:api');

Route::get('/inventories','InventoryItenController@index')->middleware('auth:api');
Route::get('/inventory/{inventoryIten}','InventoryItenController@get')->middleware('auth:api');
Route::post('/inventories','InventoryItenController@store')->middleware('auth:api');
Route::put('/inventory/{inventoryIten}','InventoryItenController@update')->middleware('auth:api','only.user');
Route::post('/inventory/{inventoryIten}/sell','InventoryItenController@sell')->middleware('auth:api','only.user');
Route::delete('/inventory/{inventoryIten}','InventoryItenController@delete')->middleware('auth:api','only.user');

Route::get('/field_types','FieldTypeController@index')->middleware('auth:api');
Route::get('/field_type/{fieldType}','FieldTypeController@get')->middleware('auth:api');
Route::post('/field_types','FieldTypeController@store')->middleware('auth:api');
Route::delete('/field_type/{fieldType}','FieldTypeController@delete')->middleware('auth:api');

Route::get('/user_token/{userToken}','UserTokenController@valid');
Route::post('/user/register','UserController@register');

Route::get('roles','RolesController@index');
