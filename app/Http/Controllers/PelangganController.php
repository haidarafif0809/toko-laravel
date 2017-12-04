<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function view()
    {
        return Pelanggan::orderBy('id', 'desc')->paginate(10);
    }
    public function search(Request $request)
    {
        $cari_pelanggan = Pelanggan::where('kode_pelanggan', 'LIKE', "%$request->search%")
            ->orWhere('nama_pelanggan', 'LIKE', "%$request->search%")
            ->orWhere('tanggal_lahir', 'LIKE', "%$request->search%")
            ->orWhere('nomor_telepon', 'LIKE', "%$request->search%")
            ->orWhere('alamat', 'LIKE', "%$request->search%")->paginate(10);
        return $cari_pelanggan;
    }

    public function store(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'kode_pelanggan' => 'required|unique:pelanggans,kode_pelanggan',
            'nama_pelanggan' => 'required',
            'tanggal_lahir'  => 'required',
            'nomor_telepon'  => 'required|unique:pelanggans,nomor_telepon',
            'alamat'         => 'required',
        ]);
        $pelanggan = Pelanggan::create([
            'kode_pelanggan' => $request->kode_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'nomor_telepon'  => $request->nomor_telepon,
            'alamat'         => $request->alamat,
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return Pelanggan::find($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kode_pelanggan' => 'required|unique:pelanggans,kode_pelanggan,' . $id,
            'nama_pelanggan' => 'required',
            'tanggal_lahir'  => 'required',
            'nomor_telepon'  => 'required|unique:pelanggans,nomor_telepon,' . $id,
            'alamat'         => 'required',
        ]);
        $pelanggan = Pelanggan::find($id)->update([
            'kode_pelanggan' => $request->kode_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'nomor_telepon'  => $request->nomor_telepon,
            'alamat'         => $request->alamat,
        ]);
    }

    public function destroy($id)
    {
        Pelanggan::destroy($id);
    }
}
