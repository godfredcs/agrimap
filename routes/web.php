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

// Auth Routes
Auth::routes();

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
	Route::post('/backup', 'BackupsController@backup');
	Route::post('/restore', 'BackupsController@restore');
});


// Support Routes
Route::get('/support' , 'SupportController@index');
Route::post('/support/send_message' , 'SupportController@sendMessage');

