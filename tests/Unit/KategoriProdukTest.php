<?php

namespace Tests\Unit;

use App\KategoriProduk;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use URL;

class KategoriProdukTest extends TestCase
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

    public function testCrudKategoriProduk()
    {
        // untuk proses tambah
        $kategori_produk = KategoriProduk::create([
            "nama_kategori_produk" => "gambas",
        ]);

        $this->assertDatabaseHas('kategori_produks', [
            "nama_kategori_produk" => "gambas",
        ]);

        // untuk proses edit
        $kategori_produk_update = KategoriProduk::find($kategori_produk->id);
        $kategori_produk_update->update([
            'nama_kategori_produk' => 'kangkung',
        ]);

        $this->assertDatabaseHas('kategori_produks', [
            'nama_kategori_produk' => 'kangkung',
        ]);

        // untuk hapus
        $hapus_kategori_produks = KategoriProduk::destroy($kategori_produk->id);
        $this->assertEquals('1', $hapus_kategori_produks);
    }
}
