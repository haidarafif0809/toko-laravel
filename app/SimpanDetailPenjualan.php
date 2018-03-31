<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpanDetailPenjualan extends Model
{
    protected $fillable = [
        'no_faktur', 'id_satuan', 'id_produk', 'id_penjualan', 'harga_produk', 'jumlah_produk', 'diskon', 'subtotal',
    ];
}
