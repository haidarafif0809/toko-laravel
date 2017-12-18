<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class TbsPenjualan extends Model
{
    use AuditableTrait;
    protected $fillable = [
        'session_id', 'satuan_id', 'produk_id', 'jumlah_produk', 'harga_produk', 'subtotal', 'toko_id',
    ];
    protected $primaryKey = 'id_tbs_pembelian';

    public function produk()
    {
        return $this->hasOne('App\Produk', 'produk_id', 'id_tbs_penjualan');
    }
}
