<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = [
        'no_faktur', 'id_produk', 'id_penjualan', 'harga_produk', 'subtotal', 'diskon', 'jumlah_produk',
    ];
    public function scopeKwantitas($query, $id_penjualan)
    {
        $query->select([
            DB::raw('SUM(detail_penjualans.jumlah_produk) as kwantitas'),
        ])
            ->where('detail_penjualans.id_penjualan', $id_penjualan);
    }
    public function scopeDetailPenjualanPerTanggal($query, $id_penjualan)
    {
        $query->select([
            'produks.nama_produk',
            'detail_penjualans.harga_produk',
            'detail_penjualans.jumlah_produk',
        ])
            ->leftJoin('penjualans', 'penjualans.id', '=', 'detail_penjualans.id_penjualan')
            ->leftJoin('pelanggans', 'pelanggans.id', '=', 'penjualans.pelanggan_id')
            ->leftJoin('produks', 'produks.produk_id', '=', 'detail_penjualans.id_produk')
            ->where('pelanggans.toko_id', Auth::user()->toko_id)
            ->where('detail_penjualans.id_penjualan', $id_penjualan);
        // ->groupBy('detail_penjualans.id');
        return $query;
    }

    public function scopeRiwayatTransaksiPelanggan($query, $id)
    {
        $query->select([
            'penjualans.id AS id_penjualan',
            'penjualans.total_bayar',
            'detail_penjualans.jumlah_produk',
            DB::raw('DATE(penjualans.created_at) as created_at'),
        ])
            ->leftJoin('penjualans', 'penjualans.id', '=', 'detail_penjualans.id_penjualan')
            ->leftJoin('pelanggans', 'pelanggans.id', '=', 'penjualans.pelanggan_id')
            ->leftJoin('produks', 'produks.produk_id', '=', 'detail_penjualans.id_produk')
            ->where('pelanggans.toko_id', Auth::user()->toko_id)
            ->where('pelanggans.id', $id)
            ->groupBy('penjualans.id');
        return $query;
    }

    public function scopeTotalRiwayatTransaksiPelanggan($query, $id)
    {
        $query->select(
            DB::raw('SUM(detail_penjualans.subtotal) as total'),
            DB::raw('SUM(detail_penjualans.jumlah_produk) as jumlah_produks'))
            ->leftJoin('penjualans', 'penjualans.id', '=', 'detail_penjualans.id_penjualan')
            ->where('penjualans.toko_id', Auth::user()->toko_id)
            ->where('penjualans.pelanggan_id', $id)
            ->groupBy('penjualans.pelanggan_id');
        return $query;
    }
}
