<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Gerai;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HttpGeraiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
       //HTTP TESTING
    //TAMBAH BANK


        //login user -> admin
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

    	$response->assertStatus(302)
    	->assertRedirect(route('gerai.create'));


    	$response2 = $this->get($response->headers->get('location'))->assertSee('Sukses :Berhasil Menambah Gerai "GeraiTest"');

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
}

