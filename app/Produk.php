<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Produk extends Model
{
    use AuditableTrait;

    protected $primaryKey = 'produk_id';

    protected $fillable = ['produk_id', 'kode_produk', 'nama_produk', 'harga_beli', 'harga_jual', 'kategori_produks_id', 'bisa_dijual', 'foto', 'satuan', 'produk_modifier_id'];
}
