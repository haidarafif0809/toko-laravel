<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Produk extends Model
{
    use AuditableTrait;

    protected $primaryKey = 'produk_id';

    protected $fillable = ['toko_id', 'kode_produk', 'nama_produk', 'harga_beli', 'harga_jual', 'kategori_produks_id', 'bisa_dijual', 'foto', 'satuan', 'produk_modifier_id'];

    public function kategori_produk()
    {
        return $this->hasOne('App\KategoriProduk', 'id', 'kategori_produks_id');
    }

    public function queryDetailProduk()
    {
        $data = Produk::select(
            'produks.produk_id',
            'produks.nama_produk',
            'produks.harga_jual',
            'produks.kategori_produks_id',
            'produks.foto',
            'produks.satuan',
            'produks.produk_modifier_id'
        )
            ->where('toko_id', Auth::user()->toko_id);
        return $data;
    }

    public function scopeDetailProduk($query, $request)
    {
        if ($request->kategori_produk == '' || $request->kategori_produk == 0) {
            $query = $this->queryDetailProduk()
                ->groupBy('produks.produk_id');
        } elseif ($request->kategori_produk != '') {
            $query = $this->queryDetailProduk()
                ->where('produks.kategori_produks_id', $request->kategori_produk)
                ->groupBy('produks.produk_id');
        }
        return $query;
    }

}
