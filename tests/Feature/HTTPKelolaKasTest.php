<?php

namespace Tests\Feature;
use URL;
use App\User;
use App\KelolaKas;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HTTPKelolaKasTest extends TestCase
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

    public function testHTTPTambahKas()
    {
        $user = User::find(2);
        $response = $this->actingAs($user)->json('POST', route('kelola-kas.store'),["toko_id" => 1, "type" =>1,"jumlah" => "12000","keterangan" => "Lunas"]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('kelola_kas',["toko_id" => 1, "type" =>1,"jumlah" => "12000", "keterangan" => "Lunas"]);
    }
    public function testAplikasiEdit(){

    	$user = User::find(2);
        $kelolaKas = KelolaKas::create(["toko_id" => 1, "type" =>2,"jumlah" => "10000","keterangan" => "Hutang"]);

        $this->assertDatabaseHas('kelola_kas',["toko_id" => 1, "type" =>2,"jumlah" => "10000","keterangan" => "Hutang"]);
      
        $response = $this->actingAs($user)->get(route('kelola-kas.edit',$kelolaKas->kelola_kas_id));

        $response->assertStatus(200)
        ->assertSee('Hutang');
    }
     //PROSES EDIT KAS
    public function testAplikasiUpdate(){

       $kelolaKas = KelolaKas::create(["toko_id" => 1, "type" =>2,"jumlah" => "10000","keterangan" => "Hutang"]);
        //login user -> MEMBER
       $user = User::find(2);

       $this->assertDatabaseHas('kelola_kas',["toko_id" => 1, "type" =>2,"jumlah" => "10000","keterangan" => "Hutang"]);

       $response = $this->actingAs($user)->json('POST', route('kelola-kas.update',$kelolaKas->kelola_kas_id), ['_method' => 'PUT',"toko_id" => 1, "type" =>2,"jumlah" => "10000","keterangan" => "Lunas"]);

       $response->assertStatus(200);
       $this->assertDatabaseHas('kelola_kas',["toko_id" => 1, "type" =>2,"jumlah" => "10000","keterangan" => "Lunas"]);

   }
    //HAPUS KAS
    public function testAplikasiHapus(){
       $kelolaKas = KelolaKas::create(["toko_id" => 1, "type" =>2,"jumlah" => "20000","keterangan" => "Lunas"]);

       // login user -> MEMBER
       $user = User::find(2);

       $response = $this->actingAs($user)->json('POST', route('kelola-kas.destroy',$kelolaKas->kelola_kas_id), ['_method' => 'DELETE']);

       $response->assertStatus(200);
       $this->assertDatabaseMissing('kelola_kas',["toko_id" => 1, "type" =>2,"jumlah" => "20000","keterangan" => "Lunas"]);

   } 
}
