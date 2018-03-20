<?php

namespace App\Http\Controllers;

use App\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanRingkas($type)
    {
        $hari   = Carbon::now()->toDay();
        $minggu = Carbon::now()->subWeek();
        $bulan  = Carbon::now()->subMonth();
        $tahun  = Carbon::now()->subYear();

        //per hari
        if ($type == 1) {
            $laporan = Penjualan::LaporanRingkas($hari)->get();
        }
        //per minggu
        elseif ($type == 2) {
            $laporan = Penjualan::LaporanRingkas($minggu)->get();
        }
        //per bulan
        elseif ($type == 3) {
            $laporan = Penjualan::LaporanRingkas($bulan)->get();
        }
        //per tahun
        elseif ($type == 4) {
            $laporan = Penjualan::LaporanRingkas($tahun)->get();
        }

        $array_laporan = [];
        $subtotal      = 0;
        $diskon        = 0;
        foreach ($laporan as $key => $val) {
            $subtotal = $subtotal + $val['subtotal'];

            $array_laporan['subtotal'] = $subtotal;

            $diskon = $diskon + $val['diskon'];

            $array_laporan['diskon'] = $diskon;
        }
        return $array_laporan;

    }

    public function grandTotalPenjualan($type)
    {
        $hari   = Carbon::now()->toDay();
        $minggu = Carbon::now()->subWeek();
        $bulan  = Carbon::now()->subMonth();
        $tahun  = Carbon::now()->subYear();

        //per hari
        if ($type == 1) {
            $laporan = Penjualan::TotalPenjualan($hari)->get();
        }
        //per minggu
        elseif ($type == 2) {
            $laporan = Penjualan::TotalPenjualan($minggu)->get();
        }
        //per bulan
        elseif ($type == 3) {
            $laporan = Penjualan::TotalPenjualan($bulan)->get();
        }

        //per tahun
        elseif ($type == 4) {
            $laporan = Penjualan::TotalPenjualan($tahun)->get();
        }

        $array_laporan       = [];
        $gt_total_penjualan  = 0;
        $gt_total_pembayaran = 0;
        foreach ($laporan as $key) {
            $gt_total_penjualan += $key->total_penjualan;
            $array_laporan['total_penjualan'] = $gt_total_penjualan;

            $gt_total_pembayaran += $key->total_pembayaran;
            $array_laporan['total_pembayaran'] = $gt_total_pembayaran;
        }
        return $array_laporan;
    }

    public function laporanPenjualanPerJam($type)
    {
        $hari   = Carbon::now()->toDay();
        $minggu = Carbon::now()->subWeek();
        $bulan  = Carbon::now()->subMonth();
        $tahun  = Carbon::now()->subYear();

        //per hari
        if ($type == 1) {
            $laporan = Penjualan::LaporanPerJam($hari)->get();
        }
        //per minggu
        elseif ($type == 2) {
            $laporan = Penjualan::LaporanPerJam($minggu)->get();
        }
        //per bulan
        elseif ($type == 3) {
            $laporan = Penjualan::LaporanPerJam($bulan)->get();
        }
        //per tahun
        elseif ($type == 4) {
            $laporan = Penjualan::LaporanPerJam($tahun)->get();
        }

        $array_laporan = [];
        foreach ($laporan as $key) {
            array_push($array_laporan, [
                'jam'              => $key->jam,
                'total_pembayaran' => $key->total_pembayaran,
                'jumlah_penjualan' => $key->total_penjualan,
            ]);
        }
        return $array_laporan;

    }

    public function laporanPenjualanHarian($type)
    {
        $hari   = Carbon::now()->toDay();
        $minggu = Carbon::now()->subWeek();
        $bulan  = Carbon::now()->subMonth();
        $tahun  = Carbon::now()->subYear();

        //per hari
        if ($type == 1) {
            $laporan = Penjualan::LaporanPenjualanHarian($hari)->get();
        }
        //per minggu
        elseif ($type == 2) {
            $laporan = Penjualan::LaporanPenjualanHarian($minggu)->get();
        }
        //per bulan
        elseif ($type == 3) {
            $laporan = Penjualan::LaporanPenjualanHarian($bulan)->get();
        }
        //per tahun
        elseif ($type == 4) {
            $laporan = Penjualan::LaporanPenjualanHarian($tahun)->get();
        }

        $array_laporan = array();
        foreach ($laporan as $laporanPenjualanHarian) {
            $tanggal = Penjualan::tanggalSql($laporanPenjualanHarian->tanggal);
            array_push($array_laporan, ['tanggal' => $tanggal, 'total_pembayaran' => $laporanPenjualanHarian->total_pembayaran, 'jumlah_penjualan' => $laporanPenjualanHarian->total_penjualan]);
        }
        return $array_laporan;

    }

    public function dataTransaksiPenjualan($type)
    {
        $hari   = Carbon::now()->toDay();
        $minggu = Carbon::now()->subWeek();
        $bulan  = Carbon::now()->subMonth();
        $tahun  = Carbon::now()->subYear();

        //per hari
        if ($type == 1) {
            $laporan = Penjualan::TransaksiPenjualan($hari)->get();
        }
        //per minggu
        elseif ($type == 2) {
            $laporan = Penjualan::TransaksiPenjualan($minggu)->get();
        }
        //per bulan
        elseif ($type == 3) {
            $laporan = Penjualan::TransaksiPenjualan($bulan)->get();
        }
        //per tahun
        elseif ($type == 4) {
            $laporan = Penjualan::TransaksiPenjualan($tahun)->get();
        }

        $array_laporan = [];
        foreach ($laporan as $key) {
            array_push($array_laporan, [
                'tanggal'   => $key->tanggal,
                'no_faktur' => $key->no_faktur,
                'pelanggan' => $key->nama_pelanggan,
                'catatan'   => $key->keterangan,
                'produk'    => $key->nama_produk,
                'subtotal'  => $key->subtotal,
                'diskon'    => $key->diskon,

            ]);
        }
        return $array_laporan;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
