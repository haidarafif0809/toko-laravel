<?php

namespace Tests\Feature;

use App\User;
use App\kelolaKas;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HTTPKelolaKasTest extends TestCase
{
	use DatabaseTransactions;

    public function testHTTPTambahKas()
    {
        $user = User::find(2);
        $response = $this->actingAs($user)->json('POST', route('kelolaKas.store'),["toko_id" => 1, "type" =>1,"jumlah" => "12000","keterangan" => "Lunas 12.000"]);
        $response->assertStatus(200);
        $this->assertDatabaseHas(["toko_id" => 1, "type" =>1,"jumlah" => "12000","keterangan" => "Lunas 12.000"]);
    }
}
