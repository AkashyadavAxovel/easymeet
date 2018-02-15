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
Route::get('/', function () {
	return redirect('login');
});
Route::get('login', 'LoginController@index');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
Route::get('dashboard', 'AdminDashboard@index');
Route::resource('users','UserController');
Route::get('users/block/{id}','UserController@block');
Route::resource('events','EventController');
Route::get('events/block/{id}','EventController@block');
