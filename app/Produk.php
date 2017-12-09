<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Produk extends Model
{
    use AuditableTrait;

    protected $primaryKey = 'produk_id';

    protected $fillable = ['produk_id', 'kode_produk', 'nama_produk', 'harga_beli', 'harga_jual', 'satuans_id', 'kategori_produks_id', 'status_jual', 'foto'];

    public function satuan()
    {
        return $this->hasOne('App\Satuan', 'id', 'produk_id');
    }

}
