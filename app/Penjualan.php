<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Penjualan extends Model
{
    //
    use AuditableTrait;
    protected $primaryKey = 'penjualan_id';
    protected $fillable   = (['penjualan_id', 'kategori_id', 'produk_id',
    ]);

    public function kategoriProduk()
    {
        return $this->hasOne('App\KategoriProduk', 'id', 'penjualan_id');
    }

    public function produk()
    {
        return $this->hasOne('App\Produk', 'id', 'produk_id');
    }

}
