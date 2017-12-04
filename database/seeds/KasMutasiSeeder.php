<?php

use App\KasMutasi;
use Illuminate\Database\Seeder;

class KasMutasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        KasMutasi::create(['dari_kas' => '1', 'ke_kas' => '2', 'jumlah' => '100', 'keterangan' => 'lunas']);
    }
}
