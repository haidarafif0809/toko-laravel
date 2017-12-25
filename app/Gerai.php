<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Gerai extends Model
{
    use AuditableTrait;
    //
    protected $fillable = (['nama_gerai', 'alamat_gerai', 'kota', 'nomor_telepon_1', 'nomor_telepon_2', 'notes', 'nama_pajak', 'rasio', 'meja',
    ]);
}
