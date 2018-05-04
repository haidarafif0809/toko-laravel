<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class TbsPenjualan extends Model
{
    use AuditableTrait;
    protected $fillable = [
        'session_id', 'id_simpan_penjualan', 'id_penjualan', 'id_modifier', 'id_kategori', 'satuan_id', 'produk_id', 'harga_produk', 'jumlah_produk', 'diskon', 'diskon_persen', 'subtotal', 'toko_id', 'keterangan',
    ];
    protected $primaryKey = 'id_tbs_penjualan';

    public function produk()
    {
        return $this->hasOne('App\Produk', 'produk_id', 'id');
    }
}
