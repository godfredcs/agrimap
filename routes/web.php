<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Route::get('crops', 'CropsController@website');
Route::get('crops/{crop}', 'CropsController@crops');

Route::get('regions', 'RegionsController@website');
Route::get('regions/{region}', 'RegionsController@regions');

Route::get('districts', 'DistrictsController@website');
Route::get('districts/{district}', 'DistrictsController@district');
Route::get('/views/week_details', 'DashboardController@getWeekDetails');

Route::post('/backup', 'BackupsController@backup');
Route::post('/restore', 'BackupsController@restore');

// Auth Routes
Auth::routes();

Route::group(['prefix' => 'admin'], function(){

	Route::get('logout', 'Auth\LoginController@logout');

	Route::get('/', 'DashboardController@index')->middleware('auth');

	Route::get('dashboard', 'DashboardController@index');


	Route::group(['middleware' => 'admin'], function(){
	    // Crops Routes
		Route::resource('crops', 'CropsController');

		// Regions Routes
		Route::resource('regions', 'RegionsController');

		// Districts Routes
		Route::resource('districts', 'DistrictsController');
		Route::post('/districts/filter', 'DistrictsController@filter');
		Route::post('/districts/search', 'DistrictsController@search');
	});

	Route::group(['middleware' => 'sys_admin'], function(){
		// Users Routes
		Route::resource('users', 'UsersController');
		Route::get('/backup', 'BackupsController@index');
	});

	// Support Routes
	Route::get('/support' , 'SupportController@index');
	Route::post('/support/send_message' , 'SupportController@sendMessage');
});





















