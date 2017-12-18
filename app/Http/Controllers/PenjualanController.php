<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\Produk;
use App\TbsPenjualan;
use DB;
use Illuminate\Http\Request;
use Session;

class PenjualanController extends Controller
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

    public function pelanggan()
    {
        $pelanggan = Pelanggan::all();
        return response()->json($pelanggan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        // return Penjualan::with('Produk')->paginate(10);
        // return Produk::paginate(5);
        // return KategoriProduk::paginate(2);
        $produk = Produk::paginate(9);
        $array  = array();
        foreach ($produk as $produks) {
            array_push($array, [
                'data_produk' => $produks,
            ]);

        }

        //DATA PAGINATION
        $respons['current_page']   = $produk->currentPage();
        $respons['data']           = $array;
        $respons['first_page_url'] = url('/penjualan/view?page=' . $produk->firstItem());
        $respons['from']           = 1;
        $respons['last_page']      = $produk->lastPage();
        $respons['last_page_url']  = url('/penjualan/view?page=' . $produk->lastPage());
        $respons['next_page_url']  = $produk->nextPageUrl();
        $respons['path']           = url('/penjualan/');
        $respons['per_page']       = $produk->perPage();
        $respons['prev_page_url']  = $produk->previousPageUrl();
        $respons['to']             = $produk->perPage();
        $respons['total']          = $produk->total();
        //
        return response()->json($respons);
    }

    public function search(Request $request)
    {
        $produk = Produk::where('nama_produk', 'LIKE', "%$request->search%")->paginate(9);
        return response()->json($produk);
    }

    public function tbsPenjualan()
    {
        $produk = Produk::select('nama_produk')->get();
        // $tbsPenjualan = TbsPenjualan::with('produk')->select(['nama_produk', 'harga_produk'])->get();
        $tbsPenjualan = DB::table('tbs_penjualans')
            ->join('produks', 'tbs_penjualans.produk_id', '=', 'produks.produk_id')
            ->select('nama_produk', 'harga_produk', 'jumlah_produk')
            ->get();
        // print_r($tbsPenjualan);
        // print_r($produk);
        // return;
        return response()->json($tbsPenjualan);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function kategori_produk()
    // {
    //     return KategoriProduk::paginate(10);
    // }

    public function produk()
    {
        return Produk::paginate(10);
    }

    public function show($id)
    {
        //
    }

    public function prosesTbsPenjualan(Request $request)
    {

        $itemTbsPenjualan = TbsPenjualan::select()->where('produk_id', $request->produk_id);
        if (count($itemTbsPenjualan->get()) > 0) {
            $item = TbsPenjualan::select()->where('produk_id', $request->produk_id)->first();
            $itemTbsPenjualan->update([
                'jumlah_produk' => $item->jumlah_produk + $request->jumlah,
            ]);
        } else {
            $session_id = session()->getId();
            $subtotal   = $request->jumlah * $request->harga;

            TbsPenjualan::create([
                'session_id'    => $session_id,
                'produk_id'     => $request->produk_id,
                'jumlah_produk' => $request->jumlah,
                'harga_produk'  => $request->harga,
                'satuan_id'     => $request->satuan,
                'subtotal'      => $subtotal,
                'toko_id'       => 1,
            ]);
        }

        return response(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
