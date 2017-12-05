<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiKas extends Model
{
    protected $fillable = [
        'jenis_transaksi', 'kas', 'kategori_transaksi', 'jumlah_masuk', 'jumlah_keluar',
    ];
}
