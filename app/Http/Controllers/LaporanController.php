<?php

namespace App\Http\Controllers;

use App\Penjualan;
use Auth;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanRingkas()
    {
        $laporan       = Penjualan::select(['subtotal', 'diskon'])->where('toko_id', Auth::user()->toko_id)->get();
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
