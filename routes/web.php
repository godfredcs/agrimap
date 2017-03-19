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

Route::get('/', 'DashboardController@index');

Route::get('dashboard', 'DashboardController@index');

// Crops Routes
Route::resource('crops', 'CropsController');

// Support Routes
Route::get('/support' , 'SupportController@index');
Route::post('/support/send_message' , 'SupportController@sendMessage');
