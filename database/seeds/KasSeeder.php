<?php

use Illuminate\Database\Seeder;
use App\Kas;

class KasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Kas::create(['kode_kas'=>'9991','nama_kas'=>'BNI']);
    	Kas::create(['kode_kas'=>'9992','nama_kas'=>'BZI']);
    	Kas::create(['kode_kas'=>'9993','nama_kas'=>'BXI']);
    }
}
