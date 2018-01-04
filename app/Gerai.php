<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Gerai extends Model
{
	use AuditableTrait;
    //
	protected $fillable = (['toko_id','nama_gerai', 'alamat_gerai', 'kota', 'no_telepon_a', 
		'no_telepon_b', 'notes', 'nama_pajak', 'rasio', 'meja',
	]);

	public function toko()
	{
		return $this->belongsTo('App\Toko', 'toko_id', 'id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'toko_id', 'id');
	}
}
