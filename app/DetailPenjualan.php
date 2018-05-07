<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = [
        'no_faktur', 'id_produk', 'id_penjualan', 'id_modifier', 'id_kategori', 'harga_produk', 'subtotal', 'diskon', 'jumlah_produk', 'created_at',
    ];

    public function scopeKwantitas($query, $id_penjualan)
    {
        $query->select([
            DB::raw('SUM(detail_penjualans.jumlah_produk) as kwantitas'),
        ])
            ->where('detail_penjualans.id_penjualan', $id_penjualan);
    }
    public function scopeDetailPenjualanPerTransaksi($query, $id_penjualan)
    {
        $query->select([
            'produks.nama_produk',
            'detail_penjualans.harga_produk',
            'detail_penjualans.jumlah_produk',
        ])
            ->leftJoin('penjualans', 'penjualans.id', '=', 'detail_penjualans.id_penjualan')
            ->leftJoin('produks', 'produks.produk_id', '=', 'detail_penjualans.id_produk')
            ->where('penjualans.toko_id', Auth::user()->toko_id)
            ->where('detail_penjualans.id_penjualan', $id_penjualan)
            ->groupBy('detail_penjualans.id');
        return $query;
    }

    public function scopeTotalRiwayatTransaksiPelanggan($query, $request)
    {
        $query->select(
            DB::raw('SUM(detail_penjualans.subtotal) as total'),
            DB::raw('SUM(detail_penjualans.jumlah_produk) as jumlah_produks')
        )
            ->leftJoin('penjualans', 'penjualans.id', '=', 'detail_penjualans.id_penjualan')
            ->where('penjualans.toko_id', Auth::user()->toko_id)
            ->where('penjualans.pelanggan_id', $request->id)
            ->groupBy('penjualans.pelanggan_id');
        return $query;
    }
    public function createDate($waktu)
    {
        $date   = date_create($waktu);
        $format = date_format($date, 'Y-m-d');
        return $format;
    }
    public function queryGrafikPenjualanProdukTeratas()
    {
        $query = DetailPenjualan::select([
            'detail_penjualans.id',
            'produks.nama_produk',
            DB::raw('SUM(detail_penjualans.jumlah_produk) as jumlah_produk'),
            DB::raw('SUM(detail_penjualans.harga_produk) as harga_produk'),
        ])
            ->leftJoin('penjualans', 'penjualans.id', '=', 'detail_penjualans.id_penjualan')
            ->leftJoin('produks', 'produks.produk_id', '=', 'detail_penjualans.id_produk')
            ->where('penjualans.toko_id', Auth::user()->toko_id);
        return $query;
    }
    public function scopeGrafikPenjualanProdukTeratas($query, $request, $hari, $minggu, $bulan, $tahun)
    {
        if ($request->dari_tanggal != "" && $request->sampai_tanggal != "") {
            $query = $this->queryGrafikPenjualanProdukTeratas()
                ->where(DB::raw('DATE(detail_penjualans.created_at)'), '>=', $this->createDate($request->dari_tanggal))
                ->where(DB::raw('DATE(detail_penjualans.created_at)'), '<=', $this->createDate($request->sampai_tanggal))
                ->orderBy('detail_penjualans.id', 'asc')
                ->groupBy('produks.nama_produk');
            # code...
        } elseif ($request->dari_tanggal == "" && $request->sampai_tanggal == "") {
            if ($request->priode == 0 || $request->priode == "") {
                $query = $this->queryGrafikPenjualanProdukTeratas()
                    ->orderBy('detail_penjualans.id', 'asc')
                    ->groupBy('produks.nama_produk');
                # code...
            }
            if ($request->priode == 1) {
                $query = $this->queryGrafikPenjualanProdukTeratas()
                    ->where('detail_penjualans.created_at', '>=', $hari)
                    ->orderBy('detail_penjualans.id', 'asc')
                    ->groupBy('produks.nama_produk');
                # code...
            }if ($request->priode == 2) {
                $query = $this->queryGrafikPenjualanProdukTeratas()
                    ->where('detail_penjualans.created_at', '>=', $minggu)
                    ->orderBy('detail_penjualans.id', 'asc')
                    ->groupBy('produks.nama_produk');
                # code...
            }if ($request->priode == 3) {
                $query = $this->queryGrafikPenjualanProdukTeratas()
                    ->where('detail_penjualans.created_at', '>=', $bulan)
                    ->orderBy('detail_penjualans.id', 'asc')
                    ->groupBy('produks.nama_produk');
                # code...
            }if ($request->priode == 4) {
                $query = $this->queryGrafikPenjualanProdukTeratas()
                    ->where('detail_penjualans.created_at', '>=', $tahun)
                    ->orderBy('detail_penjualans.id', 'asc')
                    ->groupBy('produks.nama_produk');
                # code...
                # code...
            }
        }
        return $query;

    }
    public function queryGrafikPenjualanProdukKategori()
    {
        $query = DetailPenjualan::select([
            'detail_penjualans.id',
            'kategori_produks.nama_kategori_produk',
            DB::raw('SUM(detail_penjualans.id_kategori) as jumlah_kategori'),
        ])
            ->leftJoin('kategori_produks', 'kategori_produks.id', '=', 'detail_penjualans.id_kategori')
            ->where('kategori_produks.toko_id', Auth::user()->toko_id);
        return $query;
    }
    public function scopeGrafikPenjualanProdukKategori($query, $request, $hari, $minggu, $bulan, $tahun)
    {
        if ($request->dari_tanggal != "" && $request->sampai_tanggal != "") {
            $query = $this->queryGrafikPenjualanProdukKategori()
                ->where(DB::raw('DATE(detail_penjualans.created_at)'), '>=', $this->createDate($request->dari_tanggal))
                ->where(DB::raw('DATE(detail_penjualans.created_at)'), '<=', $this->createDate($request->sampai_tanggal))
                ->orderBy('detail_penjualans.id', 'asc')
                ->groupBy('kategori_produks.nama_kategori_produk');
            # code...
        } elseif ($request->dari_tanggal == "" && $request->sampai_tanggal == "") {
            if ($request->priode == 0 || $request->priode == "") {
                $query = $this->queryGrafikPenjualanProdukKategori()
                    ->orderBy('detail_penjualans.id', 'asc')
                    ->groupBy('kategori_produks.nama_kategori_produk');
                # code...
            }
            if ($request->priode == 1) {
                $query = $this->queryGrafikPenjualanProdukKategori()
                    ->where('detail_penjualans.created_at', '>=', $hari)
                    ->orderBy('detail_penjualans.id', 'asc')
                    ->groupBy('kategori_produks.nama_kategori_produk');
                # code...
            }if ($request->priode == 2) {
                $query = $this->queryGrafikPenjualanProdukKategori()
                    ->where('detail_penjualans.created_at', '>=', $minggu)
                    ->orderBy('detail_penjualans.id', 'asc')
                    ->groupBy('kategori_produks.nama_kategori_produk');
                # code...
            }if ($request->priode == 3) {
                $query = $this->queryGrafikPenjualanProdukKategori()
                    ->where('detail_penjualans.created_at', '>=', $bulan)
                    ->orderBy('detail_penjualans.id', 'asc')
                    ->groupBy('kategori_produks.nama_kategori_produk');
                # code...
            }if ($request->priode == 4) {
                $query = $this->queryGrafikPenjualanProdukKategori()
                    ->where('detail_penjualans.created_at', '>=', $tahun)
                    ->orderBy('detail_penjualans.id', 'asc')
                    ->groupBy('kategori_produks.nama_kategori_produk');
                # code...
                # code...
            }
        }
        return $query;

    }

    public function scopeDataDetailPenjualan($query, $id_penjualan)
    {
        $query->select([
            'detail_penjualans.id_produk',
            'detail_penjualans.id_penjualan',
            'detail_penjualans.id_modifier',
            'detail_penjualans.id_kategori',
            'detail_penjualans.harga_produk',
            'detail_penjualans.jumlah_produk',
            'detail_penjualans.diskon',
            'detail_penjualans.subtotal',
        ])
            ->leftJoin('penjualans', 'penjualans.id', '=', 'detail_penjualans.id_penjualan')
            ->where('detail_penjualans.id_penjualan', $id_penjualan)
            ->where('penjualans.toko_id', Auth::user()->toko_id);
        return $query;
    }

}
