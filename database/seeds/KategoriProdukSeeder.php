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
        $kategori_produk->nama_kategori_produk = "Sembako";
        $kategori_produk->save();

        // Membuat sample kategori produk
        $kategori_produk                       = new KategoriProduk();
        $kategori_produk->nama_kategori_produk = "Fitting";
        $kategori_produk->save();

        // Membuat sample kategori produk
        $kategori_produk                       = new KategoriProduk();
        $kategori_produk->nama_kategori_produk = "Pipa";
        $kategori_produk->save();

        // Membuat sample kategori produk
        $kategori_produk                       = new KategoriProduk();
        $kategori_produk->nama_kategori_produk = "Gutter";
        $kategori_produk->save();
    }
}
