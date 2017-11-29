<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;


class KasKeluar extends Model
{
	use AuditableTrait;
	protected $fillable = [
		'kas_id', 'kategori_id', 'jumlah', 'keterangan',
	];

	public function kas() {
		return $this->belongsTo('App\Kas');
	}
	public function kategoriTransaksi() {
		return $this->belongsTo('App\KategoriTransaksi');
	}
}
