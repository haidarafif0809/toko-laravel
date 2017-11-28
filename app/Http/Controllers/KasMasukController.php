<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KasMasuk;
use App\Kas;
use App\KategoriTransaksi;

class KasMasukController extends Controller
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'kas_id' => 'required|exists:kas,id',
            'kategori_id' => 'required|exists:kategori_transaksis,id',
            'jumlah' => 'required',
            'keterangan' => 'required'
        ]);

        $kasMasuk = KasMasuk::create([
            'kas_id' => $request->kas_id,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan
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

    public function view() 
    {
        $page = KasMasuk::with('kategoriTransaksi')->paginate(10);
        return $page;
    }

    public function search(Request $request)
    {
        $search = KasMasuk::with('kategoriTransaksi')->where("kas_id", "LIKE", "%$request->pencarian")->paginate(10);
        return $search;
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
