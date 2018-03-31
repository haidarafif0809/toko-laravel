<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpanPenjualan extends Model
{
    protected $fillable = (['no_faktur', 'nomor_meja', 'catatan', 'total_bayar', 'status_pemesanan', 'pelanggan_id', 'cara_bayar', 'toko_id', 'subtotal', 'diskon', 'pajak',
    ]);
}
