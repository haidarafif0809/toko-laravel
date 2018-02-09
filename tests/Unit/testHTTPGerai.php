<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Gerai;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class testHTTPGerai extends TestCase
{
	use DatabaseTransactions;
    /**
     * A basic test .
     *
     * @return void
     */
    public function testGeraiTambah()
    {
       //HTTP TESTING

       // login user -> member
    	$user = User::find(2);

    	$response = $this->actingAs($user)->json('POST', route('gerai.store'), [
    		"nama_gerai" => "GeraiTest",
    		"alamat_gerai" => "Jepara",
    		"kota" => "Lampung",
    		"no_telepon_a"=>"082256678904",
    		"no_telepon_b"=>"082167897791",
    		"notes" => "notestest",
    		"nama_pajak" => "Service Carger",
    		"rasio" => "25",
    		"meja" => "1",
    	]);

    	$response->assertStatus(200);

    	$this->assertDatabaseHas("gerais",[
    		"nama_gerai" => "GeraiTest",
    		"alamat_gerai" => "Jepara",
    		"kota"=>"Lampung",
    		"no_telepon_a" => "082256678904",
    		"no_telepon_b" => "082167897791",
    		"notes" => "notestest",
    		"nama_pajak" => "Service Carger",
    		"rasio" => "25", 
    		"meja" => "1",
    	]);
    }

    //HALAMAN MENU UPDATE GERAI
    public function testHTTPGeraiUpdate(){

        //login user -> member toko
    	$user = User::find(2);
    	$geraiupdate = Gerai::create([
    		"toko_id" => "1",
    		"nama_gerai" => "GeraiHTTPtest",
    		"alamat_gerai" => "way jepara",
    		"kota" => "Lampung Timur", 
    		"no_telepon_a" => "082167897799",
    		"no_telepon_b" => "082167897798",
    		"notes" => "test gerai",
    		"nama_pajak" => "Service",
    		"rasio" => "20",
    		"meja" => "1"]);
    	$this->assertDatabaseHas('gerais',[
    		"toko_id" => "1",
    		"nama_gerai" => "GeraiHTTPtest",
    		"alamat_gerai" => "way jepara",
    		"kota" => "Lampung Timur", 
    		"no_telepon_a" => "082167897799",
    		"no_telepon_b" => "082167897798",
    		"notes" => "test gerai",
    		"nama_pajak" => "Service",
    		"rasio" => "20",
    		"meja" => "1",
    	]);
    	$response = $this->actingAs($user)->json('POST', route('gerai.update', $geraiupdate->id), ['_method' => 'PUT',
    		'toko_id' => '1',
    		'nama_gerai' => 'Geraiku',
    		'alamat_gerai' => 'way panjang',
    		'kota' => 'Lampung Barat', 
    		'no_telepon_a' => '082167897797',
    		'no_telepon_b' => '082167897795',
    		'notes' => 'test geraiku',
    		'nama_pajak' => 'Service Test',
    		'rasio' => '15',
    		'meja' => '0',
    	]);

    	$response->assertStatus(200);
    	$this->assertDatabaseHas('gerais',[
    		'toko_id' => '1',
    		"nama_gerai" => "Geraiku",
    		"alamat_gerai" => "way panjang",
    		"kota" => "Lampung Barat", 
    		"no_telepon_a" => "082167897797",
    		"no_telepon_b" => "082167897795",
    		"notes" => "test geraiku",
    		"nama_pajak" => "Service Test",
    		"rasio" => "15",
    		"meja" => "0",
    	]);

    }

    public function testHTTPGeraiDelete()
    {
    	$user = User::find(2);

    	$geraidelete = Gerai::create([
    		"toko_id" => "1",
    		"nama_gerai" => "Khafeku",
    		"alamat_gerai" => "natar",
    		"kota" => "bandar lampung",
    		"no_telepon_a" => "082167897793",
    		"no_telepon_b" => "082167897794",
    		"notes" => "Khafeku b",
    		"nama_pajak" => "pajak b",
    		"rasio" => "30",
    		"meja" => "1",
    	]);

    	$response = $this->actingAs($user)->json('POST', route('gerai.destroy', $geraidelete->id), ['_method' => 'DELETE']);

    	$response->assertStatus(200);

    	$this->assertDatabaseMissing('gerais',[
    		"toko_id" => "1",
    		"nama_gerai" => "Khafeku",
    		"alamat_gerai" => "natar",
    		"kota" => "bandar lampung",
    		"no_telepon_a" => "082167897793",
    		"no_telepon_b" => "082167897794",
    		"notes" => "Khafeku b",
    		"nama_pajak" => "pajak b",
    		"rasio" => "30",
    		"meja" => "1",
    	]);
    }
}

