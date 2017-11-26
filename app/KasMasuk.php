<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
	protected $fillable = [
		'kas_id', 'kategori_id', 'jumlah', 'keterangan',
	];
}
