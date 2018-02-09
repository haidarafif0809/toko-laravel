<?php

namespace Tests\Feature;

use App\Pelanggan;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use URL;

class testHTTPPelanggan extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        // kode untuk menset base url nya jadi localhost
        //   karena kalau gak localhost jadi tidak bisa jalan testing http nya
        //  selalu responnya 404
        URL::forceRootUrl('http://localhost');
    }

    //HTTP TESTING
    //TAMBAH Pelanggan
    public function testHTTPTambahPelanggan()
    {

        //login user -> admin
        $user = User::find(1);

        $response = $this->actingAs($user)->json('POST', route('pelanggan.store'), ["kode_pelanggan" => "10", "nama_pelanggan" => "Rudi", "tanggal_lahir" => "1999-10-16", "nomor_telepon" => "08976464684", "alamat" => "gunung sugih"]);

        $response->assertStatus(200);
        $this->assertDatabaseHas("pelanggans", ["kode_pelanggan" => "10", "nama_pelanggan" => "Rudi", "tanggal_lahir" => "1999-10-16", "nomor_telepon" => "08976464684", "alamat" => "gunung sugih"]);
    }

    public function testHTTPUpdatePelanggan()
    {

        $user      = User::find(1);
        $pelanggan = Pelanggan::create([
            "kode_pelanggan" => "15", "nama_pelanggan" => "test", "tanggal_lahir" => "2000-10-19", "nomor_telepon" => "0897698489", "alamat" => "Lampung Tengah",
        ]);

        $this->assertDatabaseHas("pelanggans", ["kode_pelanggan" => "15", "nama_pelanggan" => "test", "tanggal_lahir" => "2000-10-19", "nomor_telepon" => "0897698489", "alamat" => "Lampung Tengah"]);

        $response = $this->actingAs($user)->json('POST', route('pelanggan.update', $pelanggan->id), ['_method' => 'PUT', 'kode_pelanggan' => '14', 'nama_pelanggan' => 'Test Edit', 'tanggal_lahir' => '2000-10-16', 'nomor_telepon' => '089769846443', 'alamat' => 'Lampung Tengah']);
        $response->assertStatus(200);

        $this->assertDatabaseHas("pelanggans", ["kode_pelanggan" => "14", "nama_pelanggan" => "Test Edit", "tanggal_lahir" => "2000-10-16", "nomor_telepon" => "089769846443", "alamat" => "Lampung Tengah"]);

    }

    public function testDeletePelanggan()
    {
        $user      = User::find(1);
        $pelanggan = Pelanggan::create([
            "kode_pelanggan" => "18", "nama_pelanggan" => "test", "tanggal_lahir" => "2000-10-19", "nomor_telepon" => "0897698489", "alamat" => "Lampung Tengah",
        ]);
        $response = $this->actingAs($user)->json('POST', route('pelanggan.destroy', $pelanggan->id), ['_method' => 'DELETE']);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('pelanggans', [
            "kode_pelanggan" => "18", "nama_pelanggan" => "test", "tanggal_lahir" => "2000-10-19", "nomor_telepon" => "0897698489", "alamat" => "Lampung Tengah"]);
    }

}
