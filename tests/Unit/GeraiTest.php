<?php

namespace Tests\Unit;
use App\Toko;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Gerai;
use Tests\TestCase;

class GeraiTest extends TestCase
{
 use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testExample()
    {


        $gerai = Gerai::create([
         "toko_id" => "1",
         "nama_gerai" => "Moca Cafe45",
         "alamat_gerai" => "Jepara",
         "kota" => "Bandar Lampung",
         "no_telepon_a" => "082256678905",
         "no_telepon_b" => "082167897790", 
         "notes" => "masterdata gerai",
         "nama_pajak" => "Service Charge", 
         "rasio" => "20", 
         "meja" => "1"]);

        $this->assertDatabaseHas('gerais', [
            "toko_id" => "1",
            'nama_gerai' => 'Moca Cafe45',
            'alamat_gerai' => 'Jepara', 
            "kota" => "Bandar Lampung",
            'no_telepon_a' => '082256678905',
            'no_telepon_b' => '082167897790',
            'notes' => 'masterdata gerai', 
            'nama_pajak' => 'Service Charge', 
            'rasio' => '20',
            'meja' => '1']);

        Gerai::find($gerai->id)->update([
            "toko_id" => "1",
            "nama_gerai" => "Moca Cafe",
            "alamat_gerai" => "Suka Bumi",
            "kota" => "Lampung Utara",
            "no_telepon_a" => "082256678904",
            "no_telepon_b" => "082167897791", 
            "notes" => "masterdata",
            "nama_pajak" => "Service",
            "rasio" => "25", 
            "meja" => "0"]);

        $this->assertDatabaseHas('gerais', [
            "toko_id" => "1",
            'nama_gerai' => 'Moca Cafe',
            'alamat_gerai' => 'Suka Bumi',
            "kota" => "Lampung Utara",
            'no_telepon_a' => '082256678904', 
            'no_telepon_b' => '082167897791', 
            'notes' => 'masterdata', 
            'nama_pajak' => 'Service',
            'rasio' => '25',
            'meja' => '0']);

        Gerai::destroy($gerai->id);

        $this->assertDatabaseMissing('gerais', [
            "toko_id" => "1",
            'nama_gerai' => 'Moca Cafe', 
            'alamat_gerai' => 'Suka Bumi',
            "kota" => "Lampung Utara", 
            'no_telepon_a' => '082256678904', 
            'no_telepon_b' => '082167897791',
            'notes' => 'masterdata',
            'nama_pajak' => 'Service',
            'rasio' => '25', 
            'meja' => '0',
        ]);
    }
}
