<?php

use Illuminate\Database\Seeder;
use App\KasKeluar;

class KaskeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KasKeluar::create(['kas_id'=>'1', 'kategori_id'=>'1', 'jumlah'=>99, 'keterangan'=>'Nyicil']);
        KasKeluar::create(['kas_id'=>'2', 'kategori_id'=>'2', 'jumlah'=>99, 'keterangan'=>'Nyicil']);
        KasKeluar::create(['kas_id'=>'3', 'kategori_id'=>'3', 'jumlah'=>99, 'keterangan'=>'Nyicil']);
    }
}
