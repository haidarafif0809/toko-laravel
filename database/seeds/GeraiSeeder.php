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
        $tambah_gerai1 = Gerai::create([
            'nama_gerai'   => 'Athacom 1',
            'alamat_gerai' => 'jepara',
            'kota'         => 'Lampung',
            'no_telepon_a' => '081369050112',
            'no_telepon_b' => '081369050115',
            'notes'        => 'Notes1',
            'nama_pajak'   => 'pajak charge',
            'rasio'        => '10',
            'meja'         => '1',

        ]);
        $tambah_gerai2 = Gerai::create([
            'nama_gerai'   => 'Athacom 1',
            'alamat_gerai' => 'jepara',
            'kota'         => 'Lampung',
            'no_telepon_a' => '081369050112',
            'no_telepon_b' => '081369050115',
            'notes'        => 'Notes1',
            'nama_pajak'   => 'pajak charge',
            'rasio'        => '10',
            'meja'         => '1',

        ]);
        $tambah_gerai3 = Gerai::create([
            'nama_gerai'   => 'Athacom 1',
            'alamat_gerai' => 'jepara',
            'kota'         => 'Lampung',
            'no_telepon_a' => '081369050112',
            'no_telepon_b' => '081369050115',
            'notes'        => 'Notes1',
            'nama_pajak'   => 'pajak charge',
            'rasio'        => '10',
            'meja'         => '1',

        ]);

    }
}
