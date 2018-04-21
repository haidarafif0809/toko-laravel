<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class SimpanDetailPenjualan extends Model
{
    protected $fillable = [
        'no_faktur', 'id_satuan', 'id_produk', 'id_modifier', 'id_penjualan', 'harga_produk', 'jumlah_produk', 'diskon', 'diskon_persen', 'subtotal',
    ];

    public function scopeSimpanDetailProduk($query, $id_penjualan)
    {
        $query->select([
            'produks.nama_produk',
        ])
            ->leftJoin('simpan_penjualans', 'simpan_penjualans.id', '=', 'simpan_detail_penjualans.id_penjualan')
            ->leftJoin('produks', 'produks.produk_id', '=', 'simpan_detail_penjualans.id_produk')
            ->where('simpan_penjualans.toko_id', Auth::user()->toko_id)
            ->where('simpan_detail_penjualans.id_penjualan', $id_penjualan)
            ->groupBy('simpan_detail_penjualans.id');
        return $query;
    }

    public function scopeDataSimpanDetailPenjualan($query, $id_penjualan)
    {
        $query->select([
            'simpan_detail_penjualans.id_satuan',
            'simpan_detail_penjualans.id_produk',
            'simpan_detail_penjualans.id_penjualan',
            'simpan_detail_penjualans.id_modifier',
            'simpan_detail_penjualans.harga_produk',
            'simpan_detail_penjualans.jumlah_produk',
            'simpan_detail_penjualans.diskon',
            'simpan_detail_penjualans.diskon_persen',
            'simpan_detail_penjualans.subtotal',
        ])
            ->leftJoin('simpan_penjualans', 'simpan_penjualans.id', '=', 'simpan_detail_penjualans.id_penjualan')
            ->where('simpan_detail_penjualans.id_penjualan', $id_penjualan)
            ->where('simpan_penjualans.toko_id', Auth::user()->toko_id);
        return $query;
    }
}
