<?php

namespace Tests\Unit;

use App\KategoriTransaksi;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use URL;

class CrudSatuanTest extends TestCase
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

    //CRUD TESTING
    public function testKategoriTransaksiCrud()
    {
        // TAMBAH KATEGORI TRANSAKSI
        $kategoriTransaksi = KategoriTransaksi::create(["nama_kategori_transaksi" => "COBA"]);
        $this->assertDatabaseHas('kategori_transaksis', [
            'nama_kategori_transaksi' => 'COBA',
        ]);

        // UPDATE KATEGORI TRANSAKSI
        KategoriTransaksi::find($kategoriTransaksi->id)->update(["nama_kategori_transaksi" => "COBA SATUAN"]);
        $this->assertDatabaseHas('kategori_transaksis', [
            'nama_kategori_transaksi' => 'COBA SATUAN',
        ]);

        // DELETE KATEGORI TRANSAKSI
        KategoriTransaksi::destroy($kategoriTransaksi->id);
        $this->assertDatabaseMissing('kategori_transaksis', ['nama_kategori_transaksi' => 'COBA SATUAN']);
    }
}
