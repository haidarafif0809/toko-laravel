<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

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
        $adminRole               = new Role();
        $adminRole->name         = "admin";
        $adminRole->display_name = "Admin";
        $adminRole->save();
        // Membuat role member
        $memberRole               = new Role();
        $memberRole->name         = "member";
        $memberRole->display_name = "Member";
        $memberRole->save();
        // Membuat sample admin
        $admin               = new User();
        $admin->nama_toko    = 'Admin Toko Ku';
        $admin->nama_pemilik = 'Admin Toko Dasar';
        $admin->email        = 'admin@gmail.com';
        $admin->no_tlp       = '08676363';
        $admin->password     = $password;
        $admin->save();
        $admin->attachRole($adminRole);
        // Membuat sample member
        $member               = new User();
        $member->nama_toko    = "Sample Toko KU";
        $member->nama_pemilik = "Sample Member";
        $member->email        = 'member@gmail.com';
        $member->no_tlp       = "0873537373";
        $member->password     = $password;
        $member->save();
        $member->attachRole($memberRole);

    }
}
