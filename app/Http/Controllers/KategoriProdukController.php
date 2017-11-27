<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\KategoriProduk;

class KategoriProdukController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nama_produk' => 'required|unique:kategori_produks,nama_produk'
        ]);
        KategoriProduk::create([
            'nama_produk' => $request->nama_produk
        ]);
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
        return KategoriProduk::find($id);
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
            'nama_produk' => 'required|unique:kategori_produks,nama_produk,' .$id
        ]);
        KategoriProduk::find($id)->update([
            'nama_produk' => $request->nama_produk
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $hapus = KategoriProduk::destroy($id);
     return $hapus;
 }
 public function view() 
 {
    return KategoriProduk::paginate(3);
}

public function search(Request $request) {
    $nama_produk = KategoriProduk::where('nama_produk', 'LIKE', "%$request->pencarian%")->paginate(3);
    return response()->json($nama_produk);
}
}
