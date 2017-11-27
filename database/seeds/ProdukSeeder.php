<?php

use Illuminate\Database\Seeder;
use App\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // sample produk 1
    	$produk = new Produk();
    	$produk->kode_produk = "0018";
    	$produk->kode_barcode = "1234567";
    	$produk->nama_produk = "Beras 10kg";
    	$produk->harga_beli = "85000";
    	$produk->harga_jual = "90000";
    	$produk->satuans_id = "1";
    	$produk->kategori_produks_id = "1";
    	$produk->status = "Aktif";
    	$produk->supliers_id = "1";
    	$produk->limit_stok = "0";
    	$produk->over_stok = "10";
    	$produk->berkaitan_dgn_stok = "1000";
    	$produk->jenis_produk = "Produk";
    	$produk->tipe_produk = "Produk";
    	$produk->golongan = "Produk";
    	$produk->golongan_produk = "Produk";
    	$produk->save();


             // sample produk 2
    	$produk = new Produk();
    	$produk->kode_produk = "TBG";
    	$produk->nama_produk = "TABUNG GAS";
    	$produk->harga_beli = "11200";
    	$produk->harga_jual = "115000";
    	$produk->satuans_id = "5";
    	$produk->kategori_produks_id = "1";
    	$produk->status = "Aktif";
    	$produk->supliers_id = "2";
    	$produk->limit_stok = "0";
    	$produk->over_stok = "10";
    	$produk->berkaitan_dgn_stok = "1000";
    	$produk->jenis_produk = "Produk";
    	$produk->tipe_produk = "Produk";
    	$produk->golongan = "Produk";
    	$produk->golongan_produk = "Produk";
    	$produk->save();

              // sample produk 3
    	$produk = new Produk();
    	$produk->kode_produk = "020";
    	$produk->nama_produk = "DETERGEN BOOM 450 G";
    	$produk->harga_beli = "4167";
    	$produk->harga_jual = "417700";
    	$produk->satuans_id = "8";
    	$produk->kategori_produks_id = "1";
    	$produk->status = "Aktif";
    	$produk->supliers_id = "3";
    	$produk->limit_stok = "0";
    	$produk->over_stok = "10";
    	$produk->berkaitan_dgn_stok = "1000";
    	$produk->jenis_produk = "Produk";
    	$produk->tipe_produk = "Produk";
    	$produk->golongan = "Produk";
    	$produk->golongan_produk = "Produk";
    	$produk->save();
    }
}
