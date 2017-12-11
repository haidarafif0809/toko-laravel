<?php

namespace Tests\Feature;

use App\KategoriProduk;
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
    //TAMBAH KategoriProduk
    public function testHTTPTambahKategoriProduk()
    {

        //login user -> admin
        $user = User::find(1);

        $response = $this->actingAs($user)->json('POST', route('kategoriProduk.store'), ["nama_kategori_produk" => "makanan ringan"]);

        $response->assertStatus(200);
        $this->assertDatabaseHas("kategori_produks", ["nama_kategori_produk" => "makanan ringan"]);
    }

    public function testHTTPUpdateKategoriProduk()
    {

        $user           = User::find(1);
        $kategoriProduk = KategoriProduk::create([
            "nama_kategori_produk" => "makanan halal",
        ]);

        $this->assertDatabaseHas("kategori_produks", ["nama_kategori_produk" => "makanan halal"]);

        $response = $this->actingAs($user)->json('POST', route('kategoriProduk.update', $kategoriProduk->id), ['_method' => 'PUT', 'nama_kategori_produk' => '14']);
        $response->assertStatus(200);

        $this->assertDatabaseHas("kategori_produks", ["nama_kategori_produk" => "14"]);

    }

    public function testDeleteKategoriProduk()
    {
        $user           = User::find(1);
        $kategoriProduk = KategoriProduk::create([
            "nama_kategori_produk" => "18",
        ]);
        $response = $this->actingAs($user)->json('POST', route('kategoriProduk.destroy', $kategoriProduk->id), ['_method' => 'DELETE']);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('kategori_produks', [
            "nama_kategori_produk" => "18"]);
    }

}
