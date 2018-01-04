<?php

namespace Tests\Browser;
use App\Gerai;
use App\User;
use App\Toko;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GeraiTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($first,$browse) {
            $first->loginAs(User::find(2))
            ->visit('/home/gerai-create');
            $browse->pause(1000);
            $browse->type('nama_gerai', 'Geraiku');
            $browse->type('alamat_gerai','Labuhan Maringgai');
            $browse->type('kota','Bandar Lampung');
            $browse->type('no_telepon_a','082167897796');
            $browse->type('no_telepon_b','082256678904');
            $browse->type('notes','BrowserTest');
            $browser->type('nama_pajak','PajakTest');
            $browser->type('rasio','30');
            $browse->type('meja','1');
            $browse->press('btnSimpanGerai');
            $browse->assertsee('Sukses : Berhasil Menambah Gerai "Geraiku"');

        });
    }
}
