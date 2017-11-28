<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KasKeluar;

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
}
