<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = [
        'no_faktur', 'id_produk', 'id_penjualan', 'harga_produk', 'subtotal', 'diskon', 'jumlah_produk',
    ];
}
