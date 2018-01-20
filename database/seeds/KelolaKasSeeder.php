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
        // Membuat sample kelola Kas
        $kelola_kas             = new KelolaKas();
        $kelola_kas->toko_id    = 1;
        $kelola_kas->type       = 1;
        $kelola_kas->jumlah     = 5000;
        $kelola_kas->keterangan = 'Lunas';
        $kelola_kas->save();

        // Membuat sample kelola Kas
        $kelola_kas             = new KelolaKas();
        $kelola_kas->toko_id    = 1;
        $kelola_kas->type       = 2;
        $kelola_kas->jumlah     = 5000;
        $kelola_kas->keterangan = 'Ngutang';
        $kelola_kas->save();

        // Membuat sample kelola Kas
        $kelola_kas             = new KelolaKas();
        $kelola_kas->toko_id    = 1;
        $kelola_kas->type       = 1;
        $kelola_kas->jumlah     = 5000;
        $kelola_kas->keterangan = 'Nyicil';
        $kelola_kas->save();

    }
}