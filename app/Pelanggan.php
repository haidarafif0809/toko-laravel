<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Pelanggan extends Model
{
	use AuditableTrait;

	protected $fillable = [
		'toko_id','kode_pelanggan', 'nama_pelanggan', 'tanggal_lahir', 'nomor_telepon', 'alamat', 'jenis_kelamin', 'email', 'kota', 'kode_pos', 'catatan',
	];

	public function toko()
	{
		return $this->belongsTo('App\Toko', 'toko_id', 'id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'toko_id', 'id');
	}


}
