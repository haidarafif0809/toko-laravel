<?php

use Illuminate\Database\Seeder;
use App\KategoriProduk;

class KategoriProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	KategoriProduk::create([
    		'nama_produk' => 'alquran'
    	]);
    }
}
