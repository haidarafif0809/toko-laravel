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
        KelolaKas::create([
            'toko_id' => 1, 'type' => 2, 'jumlah' => 2000, 'keterangan' => 'lunas',
        ]);
        KelolaKas::create([
            'toko_id' => 1, 'type' => 1, 'jumlah' => 3000, 'keterangan' => 'lunas',
        ]);
        KelolaKas::create([
            'toko_id' => 1, 'type' => 2, 'jumlah' => 4000, 'keterangan' => 'lunas',
        ]);
        KelolaKas::create([
            'toko_id' => 1, 'type' => 1, 'jumlah' => 5000, 'keterangan' => 'lunas',
        ]);
    }
}
