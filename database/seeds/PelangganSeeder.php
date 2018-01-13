<?php

use App\Pelanggan;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Pelanggan1 = Pelanggan::create(['kode_pelanggan' => '1/mm/1', 'nama_pelanggan' => 'Galang Cahya Pamungkas', 'jenis_kelamin' => '1', 'tanggal_lahir' => '1997-12-17', 'nomor_telepon' => '085357203602', 'email' => 'galangcahyapamungkas@gmail.com', 'alamat' => 'punggur', 'kota' => 'Lampung Tengah', 'kode_pos' => '12345', 'catatan' => 'tidak ada', 'toko_id' => '1']);
        $Pelanggan2 = Pelanggan::create(['kode_pelanggan' => '1/mm/2', 'nama_pelanggan' => 'adi', 'jenis_kelamin' => '1', 'tanggal_lahir' => '1999-10-12', 'nomor_telepon' => '085373967352', 'email' => 'galangcahyapamungkas@gmail.com', 'alamat' => 'kedaton', 'kota' => 'bandar lampung', 'kode_pos' => '12346', 'catatan' => 'tidak ada', 'toko_id' => '1']);
    }
}
