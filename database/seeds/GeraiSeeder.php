<?php

use App\Gerai;
use Illuminate\Database\Seeder;

class GeraiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Gerai::create([
            'nama_gerai'   => 'Athacom 1',
            'alamat_gerai' => 'jepara',
            'kota'         => 'Lampung',
            'no_telepon_1' => '081369050112',
            'no_telepon_2' => '081369050115',
            'notes'        => 'Notes1',
            'nama_pajak'   => 'pajak charge',
            'rasio'        => '10',
            'meja'         => '1',
        ]);
    }
}
