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
        $this->call(ProdukSeeder::class);
        $this->call(KategoriProdukSeeder::class);
        $this->call(PelangganSeeder::class);
        $this->call(KelolaKasSeeder::class);
        $this->call(ModifierSeeder::class);
    }
}
