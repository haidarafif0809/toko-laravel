<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;


class KategoriTransaksi extends Model
{
	use AuditableTrait;

	protected $fillable = [
		'nama_kategori_transaksi',
	];

	public function kasMasuk() 
	{
		return $this->hasOne('App\KasMasuk');
	}
}
