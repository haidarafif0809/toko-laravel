<?php

namespace App\Http\Controllers;

use App\KategoriTransaksi;
use Illuminate\Http\Request;

class KategoriTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function view()
    {
        return KategoriTransaksi::orderBy('id', 'desc')->paginate(10);
    }
    public function search(request $request)
    {
        $search = $request->search;
        return KategoriTransaksi::where('nama_kategori_transaksi', 'LIKE', "%$request->search%")->paginate(10);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kategori_transaksi' => 'required|unique:kategori_transaksis,nama_kategori_transaksi',
        ]);
        $kategoriTransaksi = KategoriTransaksi::create(['nama_kategori_transaksi' => $request->nama_kategori_transaksi]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return KategoriTransaksi::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kategori_transaksi' => 'required|unique:kategori_transaksis,nama_kategori_transaksi,' . $id,
        ]);
        $satuan = KategoriTransaksi::find($id)->update(['nama_kategori_transaksi' => $request->nama_kategori_transaksi]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = KategoriTransaksi::destroy($id);
        return $hapus;
    }
}
