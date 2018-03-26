<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

    public function scopeLaporanRingkas($query, $waktu)
    {
        $query->select(['subtotal', 'diskon'])->where('toko_id', Auth::user()->toko_id)
            ->where('created_at', '>=', $waktu);
        return $query;
    }

    public function scopeTotalPenjualan($query, $waktu)
    {
        $query->select([DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])
            ->where('toko_id', Auth::user()->toko_id)
            ->where('created_at', '>=', $waktu);
        return $query;
    }

    public function scopeLaporanPerJam($query, $waktu)
    {
        $query->select([DB::raw('HOUR(created_at) as jam'), DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])
            ->where('toko_id', Auth::user()->toko_id)
            ->where('created_at', '>=', $waktu)
            ->groupBy(DB::raw('HOUR(created_at)'));
        return $query;
    }

    public function scopeTransaksiPenjualan($query, $waktu)
    {
        $query->select([DB::raw('DATE(penjualans.created_at) as tanggal'),
            'penjualans.subtotal as subtotal',
            'penjualans.keterangan as keterangan',
            'produks.nama_produk as nama_produk',
            'penjualans.no_faktur as no_faktur',
            'penjualans.diskon as diskon',
            'pelanggans.nama_pelanggan as nama_pelanggan',
            'cara_bayar',
        ])
            ->leftJoin('detail_penjualans', 'penjualans.id', '=', 'detail_penjualans.id_penjualan')
            ->leftJoin('pelanggans', 'pelanggan_id', '=', 'pelanggans.id')
            ->leftJoin('produks', 'detail_penjualans.id_produk', '=', 'produks.produk_id')
            ->where('penjualans.toko_id', Auth::user()->toko_id)
            ->where('.penjualans.created_at', '>=', $waktu);
        return $query;
    }

    public function scopeLaporanPenjualanHarian($query, $waktu)
    {
        $query->select([DB::raw('DATE(created_at) as tanggal'), DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $waktu)->groupBy(DB::raw('DATE(created_at)'));
        return $query;
    }

    public function scopePerilakuPelanggan($query, $id)
    {
        $query->select(DB::raw('SUM(total_bayar) as total_bayars'))
            ->where('pelanggan_id', $id);
        return $query;
    }

    public function scopeTerakhirDatang($query, $id)
    {
        $query->select(DB::raw('created_at as created_at'))
            ->where('pelanggan_id', $id)
            ->orderBy('created_at', 'desc');
        return $query;
    }

    public function scopeRataRataDatang($query, $id, $waktu)
    {
        $query->select(DB::raw('DATE(created_at) as created_at'))
            ->where('pelanggan_id', $id)
            ->where('created_at', '>=', $waktu)
            ->groupBy(DB::raw('DATE(created_at)'));
    }

    public function scopeRiwayatTransaksiPelanggan($query, $request)
    {
        $query->select([
            'penjualans.id as id_penjualan',
            'penjualans.total_bayar',
            'penjualans.created_at  AS waktu',
        ])
            ->where('penjualans.toko_id', Auth::user()->toko_id)
            ->where('penjualans.pelanggan_id', $request->id)
            ->groupBy('penjualans.id');
        return $query;
    }
}
