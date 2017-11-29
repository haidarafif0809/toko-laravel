<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Satuan;

class ProdukController extends Controller
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

    public function view(){
        return Produk::with('satuan')->paginate(10);
    }

    public function cari(Request $request) {
        $produk = Produk::with('satuan')->where('nama_produk', 'LIKE', "%$request->pencarian%")->paginate(10);
        return response()->json($produk);
    }

    public function satuan() 
    {
        $satuan = Satuan::all();
        return response()->json($satuan);
    }

    public function detail($id) 
    {
        $produk = Produk::with('satuan')->where('produk_id', $id)->first();
        return response()->json($produk);
    }

    public function detailSatuanDariProduk($id)
    {
        $produk = Produk::where('produk_id', $id)->first();
        $satuan = Satuan::where('id', $produk->satuans_id)->first();

        return response()->json($satuan);
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
    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'kode_produk'        => 'required|unique:produks,kode_produk',
            'nama_produk'         => 'required',
          // 'kategori_produks_id' => 'required|exists:kategori_produks,id',
            'harga_beli'          => 'required|numeric',
            'harga_jual'          => 'numeric',
            'satuans_id'          => 'required|exists:satuans,id'
          // 'status_jual'              => 'required'
        ]);

        //insert
        $produk = Produk::create([
            // 'kode_barcode'          =>$request->kode_barcode,
            'kode_produk'           =>$request->kode_produk,
            'nama_produk'           =>$request->nama_produk,
            // 'golongan_produk'       =>$request->golongan_produk,
            // 'kategori_produks_id'   =>$request->kategori_produks_id,
            'harga_beli'            =>$request->harga_beli,
            'harga_jual'            =>$request->harga_jual,
            'satuans_id'            =>$request->satuans_id
            // 'status_jual'                =>$request->status_jual
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
        $produk = Produk::with('satuan')->where('produk_id', $id)->first();
        // return response()->json($produk);
        return $produk;
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
            'kode_produk'        => 'required',
            // 'kode_produk' => 'required|unique:produks,kode_produk,'. $id. ', produk_id',
            'nama_produk' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'numeric',
            'satuans_id' => 'required|exists:satuans,id'
        ]);

        $produk =   Produk::find($id)->update([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'satuans_id' => $request->satuans_id
        ]);
        if ($produk == true) {
            return response(200);
        }
        else {
            return response(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Produk::destroy($id);
    }
}
