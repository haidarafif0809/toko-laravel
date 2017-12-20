<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Penjualan extends Model
{
    //
    use AuditableTrait;
    protected $fillable = (['penjualan_id', 'total', 'pelanggan_id', 'status_pembelian', 'tunai', 'kembalian', 'kredit', 'nilai_kredit', 'cara_bayar', 'status_beli_awal', 'tanggal_jt_tempo', 'keterangan', 'warung_id',
    ]);

    public function kategoriProduk()
    {
        return $this->hasOne('App\KategoriProduk', 'id', 'penjualan_id');
    }

    public function pelanggan()
    {
        return $this->hasOne('App\Pelanggan', 'id', 'produk_id');
    }

    public function tbsPenjualan()
    {
        return $this->hasOne('App\TbsPenjualan', 'id_tbs_pembelian', 'produk_id');
    }

    // public function produk()
    // {
    //     return $this->hasOne('App\Produk', 'id', 'penjualan_id');
    // }

}
