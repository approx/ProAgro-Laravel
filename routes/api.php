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
Route::get('/client/{client}/farms','ClientController@farms')->middleware('auth:api');
Route::put('/client/{client}','ClientController@update')->middleware('auth:api');
Route::delete('/client/{client}','ClientController@delete')->middleware('auth:api');
Route::post('/client','ClientController@store')->middleware('auth:api');

Route::get('/states','StateController@index')->middleware('auth:api');
Route::delete('/state/{state}','StateController@delete')->middleware('auth:api');

Route::get('/cities','CityController@index')->middleware('auth:api');
Route::delete('/city/{city}','StateController@delete')->middleware('auth:api');

Route::get('/addresses','AddressController@index')->middleware('auth:api');
Route::post('/address','AddressController@store')->middleware('auth:api');
Route::get('/address/{address}','AddressController@get')->middleware('auth:api');
Route::delete('/address/{address}','AddressController@delete')->middleware('auth:api');
Route::put('/address/{address}','AddressController@update')->middleware('auth:api');

Route::get('/farms','FarmController@index')->middleware('auth:api');
Route::get('/farm/{farm}','FarmController@get')->middleware('auth:api');
Route::get('/farm/{farm}/fields','FarmController@fields')->middleware('auth:api');
Route::get('/farm/{farm}/cultures','FarmController@cultures')->middleware('auth:api');
Route::put('/farm/{farm}','FarmController@update')->middleware('auth:api');
Route::delete('/farm/{farm}','FarmController@delete')->middleware('auth:api');
Route::post('/farm','FarmController@store')->middleware('auth:api');

Route::get('/cultures','CultureController@index')->middleware('auth:api');
Route::post('/cultures','CultureController@store')->middleware('auth:api');
Route::delete('/culture/{culture}','CultureController@delete')->middleware('auth:api');
Route::get('/culture/{culture}','CultureController@get')->middleware('auth:api');
Route::get('/culture/{culture}/farms','CultureController@farms')->middleware('auth:api');
Route::get('/culture/{culture}/crops','CultureController@crops')->middleware('auth:api');

Route::get('/fields','FieldController@index')->middleware('auth:api');
Route::get('/field/{field}','FieldController@get')->middleware('auth:api');
Route::get('/field/{field}/farm','FieldController@farm')->middleware('auth:api');
Route::get('/field/{field}/crops','FieldController@crops')->middleware('auth:api');
Route::get('/field/{field}/crop','FieldController@crop')->middleware('auth:api');
Route::put('/field/{field}','FieldController@update')->middleware('auth:api');
Route::delete('/field/{field}','FieldController@delete')->middleware('auth:api');
Route::post('/fields','FieldController@store')->middleware('auth:api');

Route::get('/crops','CropController@index')->middleware('auth:api');
Route::get('/crop/{crop}','CropController@get')->middleware('auth:api');
Route::get('/crop/{crop}/field','CropController@field')->middleware('auth:api');
Route::get('/crop/{crop}/activities','CropController@activities')->middleware('auth:api');
Route::get('/crop/{crop}/culture','CropController@culture')->middleware('auth:api');
Route::put('/crop/{crop}','CropController@update')->middleware('auth:api');
Route::delete('/crop/{crop}','CropController@delete')->middleware('auth:api');
Route::post('/crops','CropController@store')->middleware('auth:api');

Route::get('/activity_types','ActivityTypeController@index')->middleware('auth:api');
Route::get('/activity_type/{activity_type}','ActivityTypeController@get')->middleware('auth:api');
Route::get('/activity_type/{activity_type}/activities','ActivityTypeController@activities')->middleware('auth:api');
Route::put('/activity_type/{activity_type}','ActivityTypeController@update')->middleware('auth:api');
Route::delete('/activity_type/{activity_type}','ActivityTypeController@delete')->middleware('auth:api');
Route::post('/activity_types','ActivityTypeController@store')->middleware('auth:api');

Route::get('/activities','ActivityController@index')->middleware('auth:api');
Route::get('/activity/{activity}','ActivityController@get')->middleware('auth:api');
Route::get('/activity/{activity}/crop','ActivityController@crop')->middleware('auth:api');
Route::get('/activity/{activity}/activity_type','ActivityController@activityType')->middleware('auth:api');
Route::get('/activity/{activity}/unity','ActivityController@unity')->middleware('auth:api');
Route::put('/activity/{activity}','ActivityController@update')->middleware('auth:api');
Route::delete('/activity/{activity}','ActivityController@delete')->middleware('auth:api');
Route::post('/activities','ActivityController@store')->middleware('auth:api');

Route::get('/unities','UnityController@index')->middleware('auth:api');
Route::get('/unity/{unity}','UnityController@get')->middleware('auth:api');
Route::put('/unity/{unity}','UnityController@update')->middleware('auth:api');
Route::delete('/unity/{unity}','UnityController@delete')->middleware('auth:api');
Route::post('/unities','UnityController@store')->middleware('auth:api');

Route::get('/users','UserController@index')->middleware('auth:api');
Route::get('/user/{user}','UserController@get')->middleware('auth:api');
Route::get('/user/{user}/role','UserController@role')->middleware('auth:api');
Route::get('/user/{user}/address','UserController@address')->middleware('auth:api');
Route::get('/user/{user}/clients','UserController@clients')->middleware('auth:api');
Route::put('/user/{user}','UserController@update')->middleware('auth:api');
Route::delete('/user/{user}','UserController@delete')->middleware('auth:api');
Route::post('/users','UserController@store')->middleware('auth:api');
