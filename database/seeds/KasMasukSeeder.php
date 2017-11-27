<?php

use Illuminate\Database\Seeder;
use App\KasMasuk;

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
    		'kas_id' => '1', 'kategori_id' => '1', 'jumlah' => 1000, 'keterangan' => 'lunas'
    	]);
    }
}
