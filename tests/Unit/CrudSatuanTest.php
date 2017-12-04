<?php

namespace Tests\Unit;

use App\Satuan;
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
    public function testSatuanCrud()
    {
        // TAMBAH SATUAN
        $satuan = Satuan::create(["nama_satuan" => "COBA"]);
        $this->assertDatabaseHas('satuans', [
            'nama_satuan' => 'COBA',
        ]);

        // UPDATE SATUAN
        Satuan::find($satuan->id)->update(["nama_satuan" => "COBA SATUAN"]);
        $this->assertDatabaseHas('satuans', [
            'nama_satuan' => 'COBA SATUAN',
        ]);

        // DELETE SATUAN
        Satuan::destroy($satuan->id);
        $this->assertDatabaseMissing('satuans', ['nama_satuan' => 'COBA SATUAN']);
    }
}
