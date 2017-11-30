<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
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

    public function view()
    {
        return Satuan::orderBy('id', 'desc')->paginate(10);
    }
    public function search(Request $request)
    {
        $cari_satuan = Satuan::where('nama_satuan', 'LIKE', "%$request->search%")->paginate(10);
        return $cari_satuan;
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
            'nama_satuan' => 'required|unique:satuans,nama_satuan',
        ]);
        $satuan = Satuan::create(['nama_satuan' => $request->nama_satuan]);
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
        return Satuan::find($id);
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
            'nama_satuan' => 'required|unique:satuans,nama_satuan,' . $id,
        ]);
        $satuan = Satuan::find($id)->update(['nama_satuan' => $request->nama_satuan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = Satuan::destroy($id);
        return $hapus;
    }
}
