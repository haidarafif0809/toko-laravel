<?php
namespace Tests\Unit;

use App\Pelanggan;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use URL;

class CrudTeamTest extends TestCase
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
    public function testPelangganCrud()
    {
        // TAMBAH PELANGGAN
        $pelanggan = Pelanggan::create(["kode_pelanggan" => "10", "nama_pelanggan" => "adit", "tanggal_lahir" => "2000-12-12", "nomor_telepon" => "081916543", "alamat" => "sukarame"]);
        $this->assertDatabaseHas('pelanggans', [
            'kode_pelanggan' => '10', 'nama_pelanggan' => 'adit', 'tanggal_lahir' => '2000-12-12', 'nomor_telepon' => '081916543', 'alamat' => 'sukarame',
        ]);

        // UPDATE PELANGGAN
        Pelanggan::find($pelanggan->id)->update(["kode_pelanggan" => "11", "nama_pelanggan" => "aji", "tanggal_lahir" => "1999-11-10", "nomor_telepon" => "0819165437868", "alamat" => "tanjung karang"]);
        $this->assertDatabaseHas('pelanggans', [
            'kode_pelanggan' => '11', 'nama_pelanggan' => 'aji', 'tanggal_lahir' => '1999-11-10', 'nomor_telepon' => '0819165437868', 'alamat' => 'tanjung karang',
        ]);

        // DELETE PELANGGAN
        Pelanggan::destroy($pelanggan->id);
        $this->assertDatabaseMissing('pelanggans', ['kode_pelanggan' => '11', 'nama_pelanggan' => 'aji', 'tanggal_lahir' => '1999-11-10', 'nomor_telepon' => '0819165437868', 'alamat' => 'tanjung karang']);

    }

}
