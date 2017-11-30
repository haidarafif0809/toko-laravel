<?php

use App\KasKeluar;
use Illuminate\Database\Seeder;

class KaskeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KasKeluar::create(['kas_id' => '1', 'kategori_id' => '1', 'jumlah' => 99, 'keterangan' => 'Nyicil']);
    }
}
