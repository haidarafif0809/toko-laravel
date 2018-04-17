<?php

namespace App;

use Auth;
use Carbon\carbon;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class SimpanPenjualan extends Model
{
    use AuditableTrait;
    protected $fillable = (['no_faktur', 'nomor_meja', 'catatan', 'total_bayar', 'pelanggan_id', 'cara_bayar', 'toko_id', 'subtotal', 'diskon', 'pajak',
    ]);

    public function querySimpanPenjualan()
    {
        $data = SimpanPenjualan::select([
            'simpan_penjualans.created_at as waktu',
            'simpan_penjualans.nomor_meja',
            'simpan_penjualans.id',
            'simpan_penjualans.total_bayar',
            'simpan_penjualans.catatan',
            'pelanggans.nama_pelanggan',
            'users.nama_pemilik',
        ])
            ->leftJoin('pelanggans', 'pelanggans.id', '=', 'simpan_penjualans.pelanggan_id')
            ->leftJoin('users', 'users.id', '=', 'simpan_penjualans.created_by')
            ->where('simpan_penjualans.toko_id', Auth::user()->toko_id);
        return $data;
    }
    public function scopeDataSimpanPenjualan($query, $request)
    {
        $hari   = Carbon::now()->toDay();
        $minggu = Carbon::now()->subWeek();

        if ($request->priode == 0 || $request->priode == "") {
            $query = $this->querySimpanPenjualan()
                ->orderBy('simpan_penjualans.id', 'desc');
            # code...
        }if ($request->priode == 1) {
            $query = $this->querySimpanPenjualan()
                ->where('simpan_penjualans.created_at', '>=', $hari)
                ->orderBy('simpan_penjualans.id', 'desc');
            # code...
        }if ($request->priode == 2) {
            $query = $this->querySimpanPenjualan()
                ->where('simpan_penjualans.created_at', '>=', $minggu)
                ->orderBy('simpan_penjualans.id', 'desc');
            # code...
        }
        return $query;
    }
    public function ScopeCetakPesanan($query, $id_penjualan)
    {
        $query->select(
            'nomor_meja',
            'simpan_penjualans.catatan',
            'simpan_penjualans.pelanggan_id',
            'pelanggans.nama_pelanggan',
            'users.nama_pemilik'
        )
            ->leftJoin('pelanggans', 'pelanggans.id', '=', 'simpan_penjualans.pelanggan_id')
            ->leftJoin('users', 'users.id', '=', 'simpan_penjualans.created_by')
            ->where('simpan_penjualans.id', $id_penjualan);
        # code...
        return $query;
    }
}
