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

Auth::routes();

Route::get('/', function(){
	return redirect('/dashboard');
});

Route::get('dashboard', 'DashboardController@index');
<<<<<<< HEAD

// Products Routes
Route::get('products','ProductsController@index'); 
Route::post('products/store', 'ProductsController@store');
Route::post('products/restock', 'ProductsController@restock');
=======
Route::resource('products', 'ProductsController');
>>>>>>> ea33c2c66652e1aab2afda8141953f754b90aa61


// Users Routes
Route::resource('users', 'UsersController');
Route::get('my_account', 'UsersController@show');
