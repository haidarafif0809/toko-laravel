<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Penjualan extends Model
{
    //
    use AuditableTrait;
    protected $fillable = (['no_faktur', 'total_bayar', 'status_pemesanan', 'pelanggan_id', 'cara_bayar', 'keterangan', 'toko_id', 'subtotal', 'diskon', 'pajak',
    ]);

    public function kategoriProduk()
    {
        return $this->hasOne('App\KategoriProduk');
    }

    public function pelanggan()
    {
        return $this->hasOne('App\Pelanggan');
    }

    public function tbsPenjualan()
    {
        return $this->hasOne('App\TbsPenjualan');
    }
    // public function produk()
    // {
    //     return $this->hasOne('App\Produk', 'id', 'penjualan_id');
    // }

}
