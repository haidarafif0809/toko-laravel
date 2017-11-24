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

//HOME

Auth::routes();
Route::get('/', function () {
	return redirect('/home');
});
Route::get('/home', 'HomeController@index')->name('home');

	//USER
Route::resource('user','UserController',['except'=>'show']);

Route::get('/user/view','UserController@view');
Route::get('/user/pencarian','UserController@pencarian');