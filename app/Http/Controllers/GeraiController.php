<?php

namespace App\Http\Controllers;

use App\Gerai;
use Illuminate\Http\Request;

class GeraiController extends Controller
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
    public function view()
    {
        return Gerai::orderBy('id', 'desc')->paginate(10);
    }

    public function search(Request $request)
    {
        $cari_gerai = Gerai::where('nama_gerai', 'LIKE', "%$request->search%")
            ->orWhere('alamat_gerai', 'LIKE', "%$request->search%")
            ->orWhere('kota', 'LIKE', "%$request->search%")
            ->orWhere('no_telepon_1', 'LIKE', "%$request->search%")
            ->orWhere('no_telepon_2', 'LIKE', "%$request->search%")
            ->orWhere('notes', 'LIKE', "%$request->search%")
            ->orWhere('nama_pajak', 'LIKE', "%$request->search%")
            ->orWhere('rasio', 'LIKE', "%$request->search%")
            ->orWhere('meja', 'LIKE', "%$request->search%")
            ->paginate(10);
        return $cari_gerai;
    }
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
        //Validasi
        $this->validate($request, [
            'no_telepon_1' => 'required|unique:gerais,no_telepon_1',
            'no_telepon_2' => 'required|unique:gerais,no_telepon_2',

        ]);
        $Gerai = Gerai::create([
            'nama_gerai'   => $request->nama_gerai,
            'alamat_gerai' => $request->alamat_gerai,
            'kota'         => $request->kota,
            'no_telepon_1' => $request->no_telepon_1,
            'no_telepon_2' => $request->no_telepon_2,
            'notes'        => $request->notes,
            'nama_pajak'   => $request->nama_pajak,
            'rasio'        => $request->rasio,
            'meja'         => $request->meja,
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
}
