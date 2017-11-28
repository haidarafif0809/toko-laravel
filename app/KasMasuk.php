<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;


class KasMasuk extends Model
{
	use AuditableTrait;
	protected $fillable = [
		'kas_id', 'kategori_id', 'jumlah', 'keterangan',
	];

	public function kas() {
		return $this->belongsTo('App\Kas');
	}
}
