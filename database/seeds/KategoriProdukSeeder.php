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
        $kategori_produk->nama_kategori_produk = "SEMBAKO";
        $kategori_produk->save();

        // Membuat sample kategori produk
        $kategori_produk                       = new KategoriProduk();
        $kategori_produk->nama_kategori_produk = "FITTING";
        $kategori_produk->save();

        // Membuat sample kategori produk
        $kategori_produk                       = new KategoriProduk();
        $kategori_produk->nama_kategori_produk = "PIPA";
        $kategori_produk->save();

        // Membuat sample kategori produk
        $kategori_produk                       = new KategoriProduk();
        $kategori_produk->nama_kategori_produk = "GUTTER";
        $kategori_produk->save();
    }
}
