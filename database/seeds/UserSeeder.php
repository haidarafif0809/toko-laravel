<?php

use App\Role;
use App\Toko;
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
        $admin->nama_pemilik = "admin";
        $admin->email        = "admin@gmail.com";
        $admin->no_telp      = "085764688661";
        $admin->password     = $password;
        $admin->save();
        $admin->attachRole($adminRole);

        $toko2               = new Toko();
        $toko2->nama_toko    = 'Toko Sample';
        $toko2->nama_pemilik = 'member';
        $toko2->email        = 'member@gmail.com';
        $toko2->no_telp      = '1234567';
        $toko2->save();
        // Membuat sample member
        $member               = new User();
        $member->toko_id      = $toko2->id;
        $member->nama_pemilik = $toko2->nama_pemilik;
        $member->email        = $toko2->email;
        $member->no_telp      = $toko2->no_telp;
        $member->password     = $password;
        $member->save();
        $member->attachRole($memberRole);

        // $toko1               = new Toko();
        // $toko1->nama_toko    = 'toko bagus';
        // $toko1->nama_pemilik = 'bagus';
        // $toko1->email        = 'tokobagus@gmail.com';
        // $toko1->no_telp      = '1234567';
        // $toko1->save();
    }
}
