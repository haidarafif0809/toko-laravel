<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class KategoriProduk extends Model
{
    use AuditableTrait;
    protected $fillable = [
        'toko_id', 'nama_kategori_produk', 'urutan_kategori_produk',
    ];

}
