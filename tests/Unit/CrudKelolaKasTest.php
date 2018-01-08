<?php

namespace Tests\Unit;

use App\KelolaKas;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CrudKelolaKasTest extends TestCase
{
   use DatabaseTransactions;

    public function testCrudKelolaKas()
    {
    	//TAMBAH KAS MASUK
        $kelolakas = KelolaKas::create(["toko_id" => 1, "type" =>1,"jumlah" => "12000","keterangan" => "Lunas 12.000"]);
        $this->assertDatabaseHas('kelola_kas',[
        	"toko_id" => 1, "type" =>1,"jumlah" => "12000","keterangan" => "Lunas 12.000"
        ]);

        //TAMBAH KAS KELUAR
        $kelolakas = KelolaKas::create(["toko_id" => 1, "type" =>2,"jumlah" => "10000","keterangan" => "Lunas 10.000"]);
        $this->assertDatabaseHas('kelola_kas',[
        	"toko_id" => 1, "type" =>2,"jumlah" => "10000","keterangan" => "Lunas 10.000"
        ]);

        //EDIT KAS
        KelolaKas::find($kelolakas->kelola_kas_id)->update(["toko_id" => 1, "type" =>2,"jumlah" => "50000","keterangan" => "Lunas 50.000"]);
        $this->assertDatabaseHas('kelola_kas',[
        	"toko_id" => 1, "type" =>2,"jumlah" => "50000","keterangan" => "Lunas 50.000"
        ]);

        //HAPUS KAS
        KelolaKas::destroy($kelolakas->kelola_kas_id);
        $this->assertDatabaseMissing('kelola_kas',[
        	"toko_id" => 1, "type" =>2,"jumlah" => "50000","keterangan" => "Lunas 50.000"
        ]);
    }
}
