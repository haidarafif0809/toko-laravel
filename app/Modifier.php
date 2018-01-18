<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Modifier extends Model
{

    use AuditableTrait;
    protected $fillable = [
        'nama_modifier','harga_modifier'
    ];
}
