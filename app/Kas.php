<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Kas extends Model
{
	use AuditableTrait;
	
	protected $fillable = ['kode_kas','nama_kas'];

	public function kasMasuk() {
		return $this->hasOne('App\KasMasuk');
	}
	public function kasKeluar() {
		return $this->hasOne('App\KasKeluar');
	}

}
