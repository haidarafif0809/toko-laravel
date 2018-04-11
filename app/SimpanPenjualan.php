<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class SimpanPenjualan extends Model
{
    use AuditableTrait;
    protected $fillable = (['no_faktur', 'nomor_meja', 'catatan', 'total_bayar', 'pelanggan_id', 'cara_bayar', 'toko_id', 'subtotal', 'diskon', 'pajak',
    ]);
    public function scopeDataSimpanPenjualan($query)
    {
        $query->select([
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
            ->where('simpan_penjualans.toko_id', Auth::user()->toko_id)
            ->orderBy('simpan_penjualans.id', 'desc');
        return $query;
    }
}
