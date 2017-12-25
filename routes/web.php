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

Route::get('/produk/kategori_produks_id', 'ProdukController@kategoriProduksId');
Route::get('/produk/kategori_produks_id/{id}', 'ProdukController@detailKategoriProdukDariProduk');
Route::get('/produk/status_jual', 'ProdukController@statusJual');

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
Route::get('/pelanggan/detail/{id}', 'PelangganController@detail');

// Kas Mutasi
Route::resource('kas-mutasi', 'KasMutasiController', ['except' => 'show']);
Route::get('/kas-mutasi/view', 'KasMutasiController@view');

// Penjualan
Route::resource('penjualan', 'PenjualanController', ['except' => 'show']);
Route::get('/penjualan/view', 'PenjualanController@view');
Route::get('/penjualan/pencarian', 'PenjualanController@search');
Route::get('/penjualan/pelanggan', 'PenjualanController@pelanggan');
Route::post('/proses-tbs-penjualan', 'PenjualanController@prosesTbsPenjualan');
Route::get('/penjualan/hapus-tbs-penjualan/{id}', 'PenjualanController@hapusTbsPenjualan');
Route::get('/penjualan/tbs-penjualan', 'PenjualanController@tbsPenjualan');

// Toko
Route::resource('toko', 'TokoController', ['except' => 'show']);
Route::get('/toko/search', 'TokoController@search');
Route::get('/toko/view', 'TokoController@view');

// Profile Toko
Route::resource('profile-toko', 'ProfileTokoController', ['except' => 'show']);
Route::get('/profile-toko/view', 'ProfileTokoController@view');
Route::get('/profile-toko/edit', [
    'as'   => 'profile_toko.proses_ubah_profil_toko',
    'uses' => 'ProfileTokoController@proses_ubah_profil_toko',
]);
Route::get('/profile-toko/provinsi', 'ProfileTokoController@provinsi');
Route::get('/profile-toko/kabupaten/{id}/{type}', 'ProfileTokoController@kabupaten');
// Kelola Kas
Route::resource('kelola-kas', 'KelolaKasController', ['except' => 'show']);
Route::get('/kelola-kas/search', 'KelolaKasController@search');
Route::get('/kelola-kas/view', 'KelolaKasController@view');
Route::get('/kelola-kas/kas', 'KelolaKasController@kas');
//Route::get('/kelola-kas/kategoriTransaksi', 'KelolaKasController@kategoriTransaksi');
Route::get('/kelola-kas/StafAktif', 'KelolaKasController@stafAktif');
// staf toko
Route::resource('staf-toko', 'StafTokoController', ['except' => 'show']);
Route::get('staf-toko/view', 'StafTokoController@view');
Route::get('staf-toko/search', 'StafTokoController@search');

// Gerai
Route::resource('gerai', 'GeraiController', ['except' => 'show']);
Route::get('gerai/view', 'GeraiController@view');
Route::get('gerai/search', 'GeraiController@search');
