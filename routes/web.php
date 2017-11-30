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
Route::resource('user', 'UserController', ['except' => 'show']);
Route::get('/user/view', 'UserController@view');
Route::get('/user/pencarian', 'UserController@pencarian');

//KAS
Route::resource('kas', 'KasController', ['except' => 'show']);
Route::get('/kas/view', 'KasController@view');
Route::get('/kas/pencarian', 'KasController@pencarian');

// Master Data Produk
Route::resource('produk', 'ProdukController', ['except' => 'show']);
Route::get('/produk/view', 'ProdukController@view');
Route::get('/produk/cari', 'ProdukController@cari');
Route::get('/produk/satuan', 'ProdukController@satuan');
Route::get('/produk/detail/{id}', 'ProdukController@detail');
Route::get('/produk/detailSatuanDariProduk/{id}', 'ProdukController@detailSatuanDariProduk');
Route::get('/produk/edit/{id}', 'ProdukController@edit');

// kategori barang
Route::resource('kategoriProduk', 'KategoriProdukController', ['except' => 'show']);
Route::get('/kategoriProduk/view', 'KategoriProdukController@view');
Route::get('/kategoriProduk/search', 'KategoriProdukController@search');

// Satuan
Route::resource('satuan', 'SatuanController', ['except' => 'show']);
Route::get('/satuan/view', 'SatuanController@view');
Route::get('/satuan/pencarian', 'SatuanController@search');

// kas masuk
Route::resource('kasMasuk', 'KasMasukController', ['except' => 'show']);
Route::get('/kasMasuk/view', 'KasMasukController@view');
Route::get('/kasMasuk/pencarian', 'KasMasukController@search');
Route::get('/kasMasuk/kas', 'KasMasukController@kas');
Route::get('/kasMasuk/kategoriTransaksi', 'KasMasukController@kategoriTransaksi');
Route::get('/kasMasuk/dataKas/{id}', 'KasMasukController@dataKas');
Route::get('/kasMasuk/dataTransaksi/{id}', 'KasMasukController@dataTransaksi');

// KAS KELUAR
Route::resource('kas-keluar', 'KasKeluarController', ['except' => 'show']);
Route::get('/kas-keluar/view', 'KasKeluarController@view');
Route::get('/kas-keluar/pencarian', 'KasKeluarController@pencarian');
Route::get('/kas-keluar/kas', 'KasKeluarController@kas');
Route::get('/kas-keluar/kategoriTransaksi', 'KasKeluarController@kategoriTransaksi');

// Kategori Transaksi
Route::resource('kategoriTransaksi', 'KategoriTransaksiController', ['except' => 'show']);
Route::get('/kategoriTransaksi/view', 'KategoriTransaksiController@view');
Route::get('/kategoriTransaksi/pencarian', 'KategoriTransaksiController@search');

// Suplier
Route::resource('suplier', 'SuplierController', ['except' => 'show']);
Route::get('/suplier/view', 'SuplierController@view');
Route::get('/suplier/search', 'SuplierController@search');

// Satuan
Route::resource('pelanggan', 'PelangganController', ['except' => 'show']);
Route::get('/pelanggan/view', 'PelangganController@view');
Route::get('/pelanggan/pencarian', 'PelangganController@search');
