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
        $type1               = 0;
        $status1             = 1;
        $admin               = new User();
        $admin->type         = $type1;
        $admin->nama_pemilik = "admin";
        $admin->email        = "admin@gmail.com";
        $admin->no_telp      = "085764688661";
        $admin->status       = $status1;
        $admin->is_verified  = $status1;
        $admin->password     = $password;
        $admin->save();
        $admin->attachRole($adminRole);

        $toko1               = new Toko();
        $toko1->nama_toko    = 'Toko Sample';
        $toko1->nama_pemilik = 'member';
        $toko1->email        = 'member@gmail.com';
        $toko1->no_telp      = '1134567';
        $toko1->save();
        // Membuat sample member
        $type                 = 1;
        $status               = 1;
        $member               = new User();
        $member->type         = $type;
        $member->toko_id      = $toko1->id;
        $member->nama_toko    = $toko1->nama_toko;
        $member->nama_pemilik = $toko1->nama_pemilik;
        $member->email        = $toko1->email;
        $member->no_telp      = $toko1->no_telp;
        $member->status       = $status;
        $member->is_verified  = $status;
        $member->password     = $password;
        $member->save();
        $member->attachRole($memberRole);

        // $toko1               = new Toko();
        // $toko1->nama_toko    = 'toko bagus';
        // $toko1->nama_pemilik = 'bagus';
        // $toko1->email        = 'tokobagus@gmail.com';
        // $toko1->no_telp      = '1134567';
        // $toko1->save();
    }
}
