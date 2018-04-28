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
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
//USER
    Route::resource('user', 'UserController', ['except' => 'show']);
    Route::get('/user/view', 'UserController@view');
    Route::get('/user/pencarian', 'UserController@pencarian');
    Route::get('/user/viewStaff', 'UserController@viewStaff');
// status toko(aktif/nonaktof)
    Route::get('/user/status/{id}', [
        'middleware' => ['auth'],
        'as'         => 'user.status',
        'uses'       => 'UserController@status',
    ]);

// Toko
    Route::resource('toko', 'TokoController', ['except' => 'show']);
    Route::get('/toko/search', 'TokoController@search');
    Route::get('/toko/view', 'TokoController@view');
});
Route::get('/home', 'HomeController@index')->name('home');

// Master Data Produk
Route::resource('produk', 'ProdukController', ['except' => 'show']);
Route::get('/produk/view', 'ProdukController@view');
Route::get('/produk/cari', 'ProdukController@cari');

//kategori produk
Route::get('/produk/kategori_produks_id', 'ProdukController@kategoriProduksId');
Route::get('/produk/kategori_produks_id/{id}', 'ProdukController@detailKategoriProdukDariProduk');
Route::get('/produk/status_jual', 'ProdukController@statusJual');

//modifier produk
Route::get('/produk/produk-modifier-id', 'ProdukController@produkModifiersId');
Route::get('/produk/produk-modifier-id/{id_produk}', 'ProdukController@produkModifiersIdEdit');
Route::get('/produk/modifier', 'ProdukController@modifier');
Route::get('/produk/produk-modifier', 'ProdukController@detailModifier');
Route::resource('modifier', 'ModifierController', ['except' => 'show']);

Route::get('/produk/detail/{id}', 'ProdukController@detail');
Route::get('/produk/detailSatuanDariProduk/{id}', 'ProdukController@detailSatuanDariProduk');
Route::get('/produk/edit/{id}', 'ProdukController@edit');
Route::get('/produk/template_import', 'ProdukController@generateExcelTemplate');
Route::post('/produk/import_produk', 'ProdukController@importExcel');

// kategori barang
Route::resource('kategoriProduk', 'KategoriProdukController', ['except' => 'show']);
Route::get('/kategoriProduk/view', 'KategoriProdukController@view');
Route::get('/kategoriProduk/search', 'KategoriProdukController@search');

// Penjualan
Route::resource('penjualan', 'PenjualanController', ['except' => 'show']);
Route::post('/notification/get', 'PenjualanController@notification');
Route::post('/notification/read', 'PenjualanController@notificationRead');
Route::post('/penjualan/view', 'PenjualanController@view');
Route::get('/penjualan/data-modifier/{id_produk}', 'PenjualanController@dataModifier');
Route::post('/penjualan/riwayat-penjualan', 'PenjualanController@dataRiwayatPenjualan');
Route::get('/penjualan/detail-riwayat-penjualan', 'PenjualanController@detailRiwayatPenjualan');
Route::get('/penjualan/cetak-penjualan', 'PenjualanController@cetakPenjualan');
Route::get('/penjualan/cetak-pesanan', 'PenjualanController@cetakPesanan');
Route::get('/penjualan/diskon-simpan-penjualan', 'PenjualanController@diskonSimpanPenjualan');
Route::get('/penjualan/create-tbs-penjualan', 'PenjualanController@createTbsPenjualan');
Route::get('/penjualan/view-buka-penjualan', 'PenjualanController@viewBukaPenjualan');
Route::post('/simpan-penjualan', 'PenjualanController@simpanDataPenjualan');
Route::get('/penjualan/pencarian', 'PenjualanController@search');
Route::get('/penjualan/pelanggan', 'PenjualanController@pelanggan');
Route::post('/proses-tbs-penjualan', 'PenjualanController@prosesTbsPenjualan');
Route::post('/update-tbs-penjualan', 'PenjualanController@ubahTbsPenjualan');
Route::post('/update-diskon-tbs-penjualan', 'PenjualanController@ubahDiskonProdukTbsPenjualan');
Route::post('/update-diskon-faktur-tbs-penjualan', 'PenjualanController@ubahDiskonFakturTbsPenjualan');

// Route::resource('buka-penjualan', 'BukaPenjualanController', ['except' => 'show']);

// hapus item penjualan
Route::delete('/penjualan/hapus-tbs-penjualan/{id}', [
    'middleware' => ['auth'],
    'as'         => 'penjualan.hapus_tbs_penjualan',
    'uses'       => 'PenjualanController@hapusTbsPenjualan',
]);
Route::delete('/penjualan/hapus-simpan-penjualan/{id}', [
    'middleware' => ['auth'],
    'as'         => 'penjualan.hapus_tbs_penjualan',
    'uses'       => 'PenjualanController@hapusSimpanPenjualan',
]);
// ketegori produk pada penjualan
Route::get('/penjualan/kategori-produk', 'PenjualanController@kategoriProduk');
Route::get('/penjualan/tbs-penjualan', 'PenjualanController@tbsPenjualan');
Route::get('/penjualan/datail-produk', 'PenjualanController@detailProduk');

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

// Pelanggan
Route::resource('pelanggan', 'PelangganController', ['except' => 'show']);
Route::get('/pelanggan/riwayat_transaksi', 'PelangganController@riwayatTransaksi');
Route::post('/pelanggan/post_riwayat_transaksi', 'PelangganController@posRiwayatTransaksi');
Route::get('/pelanggan/total_riwayat_transaksi', 'PelangganController@totalRiwayatTransaksi');
Route::post('/pelanggan/post_total_riwayat_transaksi', 'PelangganController@postTotalRiwayatTransaksi');
Route::get('/pelanggan/data_produk_per_tgl/{tanggal}', 'PelangganController@dataProdukRiwayatTransaksiPerTgl');
Route::get('/pelanggan/view', 'PelangganController@view');
Route::get('/pelanggan/pencarian', 'PelangganController@search');
Route::get('/pelanggan/perilaku/{id}', 'PelangganController@perilaku');
Route::get('/pelanggan/template_import', 'PelangganController@generateExcelTemplate');
Route::post('/pelanggan/import_pelanggan', 'PelangganController@importExcel');
Route::get('/pelanggan/export_pelanggan', 'PelangganController@exportExcel');

//laporan
Route::resource('laporan', 'LaporanController', ['except' => 'show']);
Route::get('/laporan/laporan-ringkas', 'LaporanController@laporanRingkas');
Route::get('/laporan/laporan-penjualan-harian', 'LaporanController@laporanPenjualanHarian');
Route::get('/laporan/laporan-penjualan-perjam', 'LaporanController@laporanPenjualanPerJam');
Route::get('/laporan/grand-total-penjualan', 'LaporanController@grandTotalPenjualan');
Route::get('/laporan/data-transaksi-penjualan', 'LaporanController@dataTransaksiPenjualan');
Route::get('/laporan/rekapitulasi-kas', 'LaporanController@LaporanRekapitulasiKas');

// verifikasi user baru
Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');
Route::get('auth/verifyStaff/{token}', 'Auth\RegisterController@verifyStaff');
// ubah password
Route::get('ubah-password/password', 'UbahPasswordController@editPassword');
Route::post('ubah-password/password', 'UbahPasswordController@updatePassword');
