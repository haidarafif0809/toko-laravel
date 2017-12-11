<?php

use App\KasMasuk;
use Illuminate\Database\Seeder;

class KasMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KasMasuk::create([
            'toko_id' => 1, 'type' => 1, 'jumlah' => 1000, 'keterangan' => 'lunas',
        ]);
    }
}
