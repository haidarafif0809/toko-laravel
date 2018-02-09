<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PelangganTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testTambahPelanggan()
    {
        $this->browse(function ($first) {
            $first->loginAs(User::find(1))
                ->visit('/home#/pelanggan/pelanggan-create')
            // ->click("Tambah Pelanggan")
                ->type('kode_pelanggan', '10')
                ->type('tanggal_lahir', '31/01/2000')
                ->type('nomor_telepon', '089767')
                ->type('alamat', 'lampung')
                ->press('.btn-primary')
                ->assertSee('Berhasil Menambahkan Pelanggan');
        });

    }
}
