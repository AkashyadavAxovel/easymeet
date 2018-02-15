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
Route::get('dashboard', function () {
    return view('admin.dashboard.home');
});
Route::resource('users','UserController');
Route::get('users/block/{id}','UserController@block');
