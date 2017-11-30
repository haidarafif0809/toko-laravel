<?php

use Illuminate\Database\Seeder;
use App\Pelanggan;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$Pelanggan1 = Pelanggan::create(['kode_pelanggan' => '1','nama_pelanggan' => 'Galang Cahya Pamungkas','tanggal_lahir' => '1997-12-17','nomor_telepon'=>'085357203602','alamat'=>'punggur']);
    	$Pelanggan2 = Pelanggan::create(['kode_pelanggan' => '2','nama_pelanggan' => 'adi','tanggal_lahir' => '1999-10-12','nomor_telepon'=>'085373967352','alamat'=>'bandar lampung']);
    }
}