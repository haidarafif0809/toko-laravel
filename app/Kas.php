<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Kas extends Model
{
	use AuditableTrait;
	
	protected $fillable = ['kode_kas','nama_kas'];
}
