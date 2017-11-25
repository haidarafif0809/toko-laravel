<?php

namespace App;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
	use AuditableTrait;
	protected $fillable = [
		'nama_satuan'
	];
}
