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
// 
Route::resource('produk', 'ProdukController', ['except' => 'show']);
Route::get('/produk/view','ProdukController@view');
Route::get('/produk/cari','ProdukController@cari');

// kategori barang
Route::resource('kategoriProduk', 'KategoriProdukController', ['except' => 'show']);
Route::get('/kategoriProduk/view','KategoriProdukController@view');
Route::get('/kategoriProduk/search','KategoriProdukController@search');

// Satuan
Route::resource('satuan','SatuanController',['except'=>'show']);
Route::get('/satuan/view', 'SatuanController@view');
Route::get('/satuan/pencarian', 'SatuanController@search');