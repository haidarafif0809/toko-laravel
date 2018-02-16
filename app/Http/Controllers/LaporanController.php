<?php

namespace App\Http\Controllers;

use App\Penjualan;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $laporan       = Penjualan::select(['subtotal', 'diskon'])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $hari)->get();
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

        //per minggu
        if ($type == 2) {
            $laporan       = Penjualan::select(['subtotal', 'diskon'])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $minggu)->get();
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

        //per bulan
        if ($type == 3) {
            $laporan       = Penjualan::select(['subtotal', 'diskon'])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $bulan)->get();
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

        //per tahun
        if ($type == 4) {
            $laporan       = Penjualan::select(['subtotal', 'diskon'])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $tahun)->get();
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

    }

    public function laporanPenjualanHarian()
    {
        $laporan       = Penjualan::select([DB::raw('DATE(created_at) as tanggal'), DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])->where('toko_id', Auth::user()->toko_id)->groupBy(DB::raw('DATE(created_at)'))->get();
        $array_laporan = array();
        foreach ($laporan as $key) {
            array_push($array_laporan, ['tanggal' => $key->tanggal, 'total_pembayaran' => $key->total_pembayaran, 'jumlah_penjualan' => $key->total_penjualan]);
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
            $laporan             = Penjualan::select([DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $hari)->get();
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

        //per minggu
        if ($type == 2) {
            $laporan             = Penjualan::select([DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $minggu)->get();
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

        //per bulan
        if ($type == 3) {
            $laporan             = Penjualan::select([DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $bulan)->get();
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

        //per tahun
        if ($type == 4) {
            $laporan             = Penjualan::select([DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $tahun)->get();
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
    }

    public function laporanPenjualanPerJam($type)
    {
        $hari   = Carbon::now()->toDay();
        $minggu = Carbon::now()->subWeek();
        $bulan  = Carbon::now()->subMonth();
        $tahun  = Carbon::now()->subYear();

        //per hari
        if ($type == 1) {
            $laporan       = Penjualan::select([DB::raw('HOUR(created_at) as jam'), DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $hari)->groupBy(DB::raw('HOUR(created_at)'))->get();
            $array_laporan = array();
            foreach ($laporan as $key) {
                array_push($array_laporan, ['jam' => $key->jam, 'total_pembayaran' => $key->total_pembayaran, 'jumlah_penjualan' => $key->total_penjualan]);
            }
            return $array_laporan;
        }
        //per minggu
        elseif ($type == 2) {
            $laporan       = Penjualan::select([DB::raw('HOUR(created_at) as jam'), DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $minggu)->groupBy(DB::raw('HOUR(created_at)'))->get();
            $array_laporan = array();
            foreach ($laporan as $key) {
                array_push($array_laporan, ['jam' => $key->jam, 'total_pembayaran' => $key->total_pembayaran, 'jumlah_penjualan' => $key->total_penjualan]);
            }
            return $array_laporan;
        }
        //per bulan
        elseif ($type == 3) {
            $laporan       = Penjualan::select([DB::raw('HOUR(created_at) as jam'), DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $bulan)->groupBy(DB::raw('HOUR(created_at)'))->get();
            $array_laporan = array();
            foreach ($laporan as $key) {
                array_push($array_laporan, ['jam' => $key->jam, 'total_pembayaran' => $key->total_pembayaran, 'jumlah_penjualan' => $key->total_penjualan]);
            }
            return $array_laporan;
        }
        //per tahun
        elseif ($type == 4) {
            $laporan       = Penjualan::select([DB::raw('HOUR(created_at) as jam'), DB::raw('SUM(total_bayar) as total_pembayaran'), DB::raw('COUNT(*) as total_penjualan')])->where('toko_id', Auth::user()->toko_id)->where('created_at', '>=', $tahun)->groupBy(DB::raw('HOUR(created_at)'))->get();
            $array_laporan = array();
            foreach ($laporan as $key) {
                array_push($array_laporan, ['jam' => $key->jam, 'total_pembayaran' => $key->total_pembayaran, 'jumlah_penjualan' => $key->total_penjualan]);
            }
            return $array_laporan;
        }

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
