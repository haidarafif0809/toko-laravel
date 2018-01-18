<?php

use App\KategoriProduk;
use Illuminate\Database\Seeder;

class KategoriProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat sample kategori produk
        $kategori_produk                       = new KategoriProduk();
        $kategori_produk->nama_kategori_produk = "Makanan";
        $kategori_produk->toko_id              = "1";
        $kategori_produk->save();

        // Membuat sample kategori produk
        $kategori_produk                       = new KategoriProduk();
        $kategori_produk->nama_kategori_produk = "Minuman";
        $kategori_produk->toko_id              = "1";
        $kategori_produk->save();

        // Membuat sample kategori produk
        $kategori_produk                       = new KategoriProduk();
        $kategori_produk->nama_kategori_produk = "Dissert";
        $kategori_produk->toko_id              = "1";
        $kategori_produk->save();

        // Membuat sample kategori produk
        $kategori_produk                       = new KategoriProduk();
        $kategori_produk->nama_kategori_produk = "Cemilan";
        $kategori_produk->toko_id              = "1";
        $kategori_produk->save();
    }
}
