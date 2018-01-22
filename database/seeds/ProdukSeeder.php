<?php

use App\Produk;
use Illuminate\Database\Seeder;

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
        $produk                      = new Produk();
        $produk->toko_id             = 1;
        $produk->nama_produk         = "Fettuccine Carbonara";
        $produk->harga_jual          = "3336250";
        $produk->kategori_produks_id = "1";
        $produk->bisa_dijual         = 1;
        $produk->satuan              = 1;
        $produk->produk_modifier_id  = 1;
        $produk->save();

        // sample produk 2
        $produk                      = new Produk();
        $produk->toko_id             = 1;
        $produk->nama_produk         = "Steak and Cheese with French Onion Dip";
        $produk->harga_jual          = "3603150";
        $produk->kategori_produks_id = "1";
        $produk->bisa_dijual         = 1;
        $produk->satuan              = 2;
        $produk->produk_modifier_id  = 2;
        $produk->save();

        // sample produk 3
        $produk                      = new Produk();
        $produk->toko_id             = 1;
        $produk->nama_produk         = "French Onion Soup";
        $produk->harga_jual          = "2669000";
        $produk->kategori_produks_id = "1";
        $produk->bisa_dijual         = 1;
        $produk->satuan              = 3;
        $produk->produk_modifier_id  = 3;
        $produk->save();
    }
}
