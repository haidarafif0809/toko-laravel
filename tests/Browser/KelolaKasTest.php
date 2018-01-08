<?php

namespace Tests\Browser;
use URL;
use App\User;
use App\KelolaKas;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KelolaKasTest extends DuskTestCase
{
		use DatabaseTransactions;
	protected function setUp()
    {
        parent::setUp();
        // kode untuk menset base url nya jadi localhost
        //   karena kalau gak localhost jadi tidak bisa jalan testing http nya
        //  selalu responnya 404
        URL::forceRootUrl('http://localhost');
    }
    public function testTambahKas() {
      $this->browse(function ($kelolaKas) {
        $kelolaKas->loginAs(User::find(2))
        ->visit('/kelola-kas')
        //->clickLink('createKelolaKas')
        ->visit('kelola-kas/create')
        ->radio('type',1)
        ->type('jumlah',123.000)
        ->type('keterangan','ngutang');
      });
    }
}
