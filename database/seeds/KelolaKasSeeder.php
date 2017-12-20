<?php

use App\KelolaKas;
use Illuminate\Database\Seeder;

class KelolaKasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KelolaKas::create([
            'toko_id' => 1, 'type' => 1, 'jumlah' => 1000, 'keterangan' => 'lunas',
        ]);
    }
}
