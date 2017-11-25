<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$password = 'rahasia';
    	$admin =  User::create(['name' => 'admin' ,'email' => 'admin@gmail.com','password' =>$password]);
    	$member = User::create(['name' => 'member' ,'email' => 'member@gmail.com','password' =>$password]);
    }
}
