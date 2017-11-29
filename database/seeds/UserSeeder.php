<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

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

        // Membuat role admin
        $adminRole = new Role();
        $adminRole->name = "admin";
        $adminRole->display_name = "Admin";
        $adminRole->save();
        // Membuat role member
        $memberRole = new Role();
        $memberRole->name = "member";
        $memberRole->display_name = "Member";
        $memberRole->save();
        // Membuat sample admin
        $admin = new User();
        $admin->name = 'Admin Toko Dasar';
        $admin->email = 'admin@gmail.com';
        $admin->password = $password;
        $admin->save();
        $admin->attachRole($adminRole);
        // Membuat sample member
        $member = new User();
        $member->name = "Sample Member";
        $member->email = 'member@gmail.com';
        $member->password = $password;
        $member->save();
        $member->attachRole($memberRole);

    }
}
