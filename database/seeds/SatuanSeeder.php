<?php

use Illuminate\Database\Seeder;
use App\Satuan;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $satuan1 = Satuan::create(['nama_satuan'=>'PCS']);
        $satuan2 = Satuan::create(['nama_satuan'=>'DUS']);
        $satuan3 = Satuan::create(['nama_satuan'=>'RIM']);
        $satuan4 = Satuan::create(['nama_satuan'=>'UNIT']);
        $satuan5 = Satuan::create(['nama_satuan'=>'KG']);
        $satuan6 = Satuan::create(['nama_satuan'=>'IKAT']);
        $satuan7 = Satuan::create(['nama_satuan'=>'KARUNG']);
        $satuan7 = Satuan::create(['nama_satuan'=>'BUNGKUS']);
        $satuan7 = Satuan::create(['nama_satuan'=>'TABUNG']);
        $satuan7 = Satuan::create(['nama_satuan'=>'LITER']);

    }
}
