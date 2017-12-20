<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KasSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(KategoriProdukSeeder::class);
        $this->call(SatuanSeeder::class);
        $this->call(KategoriTransaksiSeeder::class);
        $this->call(SuplierSeeder::class);
        $this->call(PelangganSeeder::class);
        $this->call(KelolaKasSeeder::class);
    }
}
