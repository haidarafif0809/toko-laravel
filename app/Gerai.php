<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Gerai extends Model
{
    use AuditableTrait;
    //
    protected $fillable = (['nama_gerai', 'alamat_gerai', 'kota', 'no_telepon_a', 'no_telepon_b', 'notes', 'nama_pajak', 'rasio', 'meja',
    ]);
}
