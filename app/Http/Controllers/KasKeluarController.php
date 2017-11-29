<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kas;
use App\KasKeluar;
use App\KategoriTransaksi;

class KasKeluarController extends Controller
{
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
        $this->validate($request, [
            'kas_id' => 'required|exists:kas,id',
            'kategori_id' => 'required|exists:kategori_transaksis,id',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required'
        ]);

        $kasKeluar = KasKeluar::create([
            'kas_id' => $request->kas_id,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);
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
    public function view()
    {
        $index_kas_keluar = KasKeluar::paginate(10);
        return $index_kas_keluar;
    }
    public function pencarian(Request $request)
    {
        $cari_kas_keluar = KasKeluar::where('kas_id','LIKE',"%$request->search%")->orWhere('jumlah','LIKE',"%$request->search%")->paginate(10);
        return $cari_kas_keluar;
    }
    public function kas() {
        $kas = Kas::all();
        return response()->json($kas);
    }

    public function kategoriTransaksi() {
        $kategoriTransaksi = KategoriTransaksi::all();
        return response()->json($kategoriTransaksi);
    }
}
