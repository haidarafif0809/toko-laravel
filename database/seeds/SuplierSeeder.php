<?php

use Illuminate\Database\Seeder;
use App\Suplier;

class SuplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$suplier1 = Suplier::create(['nama_suplier' => 'suplier1','alamat_suplier' => 'alamat1','no_telp_suplier' => '082237273731']);

    	$suplier2 = Suplier::create(['nama_suplier' => 'suplier2','alamat_suplier' => 'alamat2','no_telp_suplier' => '082237273732']);

    	$suplier3 = Suplier::create(['nama_suplier' => 'suplier3','alamat_suplier' => 'alamat3','no_telp_suplier' => '082237273733']);
    }
}
