<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Pelanggan extends Model
{
	use AuditableTrait;

	protected $fillable = [
		'kode_pelanggan', 'nama_pelanggan', 'tanggal_lahir', 'nomor_telepon', 'alamat', 'jenis_kelamin', 'email', 'kota', 'kode_pos', 'catatan',
	];

}
