<?php

namespace App;

use App\Pelanggan;
use App\Toko;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Pelanggan extends Model
{
    use AuditableTrait;

    protected $fillable = [
        'toko_id', 'kode_pelanggan', 'nama_pelanggan', 'tanggal_lahir', 'nomor_telepon', 'alamat', 'jenis_kelamin', 'email', 'kota', 'kode_pos', 'catatan',
    ];

    public function toko()
    {
        return $this->belongsTo('App\Toko', 'toko_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'toko_id', 'id');
    }

    public static function kode_pelanggan($id_toko)
    {
        $datatoko      = Toko::select('id', 'prefix_member_id')->where('id', $id_toko)->first();
        $dataPelanggan = Pelanggan::where('toko_id', $id_toko)->orderBy('id', 'desc');
        $pelanggan     = $dataPelanggan->first();
        if ($pelanggan != null) {
            $pisah_nomor = explode("/", $pelanggan->kode_pelanggan);
            $ambil_nomor = $pisah_nomor[2];
        } else {
            $ambil_nomor = 1;
        }

        if ($dataPelanggan->count() > 0) {
            $nomor          = 1 + $ambil_nomor;
            $kode_pelanggan = $datatoko->id . "/" . $datatoko->prefix_member_id . "/" . $nomor;
        } else {
            $nomor          = 1;
            $kode_pelanggan = $datatoko->id . "/" . $datatoko->prefix_member_id . "/" . $nomor;
        }

        return $kode_pelanggan;
    }

}
