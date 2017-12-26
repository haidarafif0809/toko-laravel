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
        return Pelanggan::orderBy('created_at', 'desc')->paginate(10);
    }
    public function search(Request $request)
    {
        $cari_pelanggan = Pelanggan::where('kode_pelanggan', 'LIKE', "%$request->search%")
            ->orWhere('nama_pelanggan', 'LIKE', "%$request->search%")
        // ->orWhere('tanggal_lahir', 'LIKE', "%$request->search%")
            ->orWhere('nomor_telepon', 'LIKE', "%$request->search%")
        // ->orWhere('alamat', 'LIKE', "%$request->search%")
        // ->orWhere('jenis_kelamin', 'LIKE', "%$request->search%")
        // ->orWhere('email', 'LIKE', "%$request->search%")
        // ->orWhere('kota', 'LIKE', "%$request->search%")
        // ->orWhere('kode_pos', 'LIKE', "%$request->search%")
        // ->orWhere('catatan', 'LIKE', "%$request->search%")
            ->paginate(10);
        return $cari_pelanggan;
    }

    public function detail($id)
    {
        $detailPelanggan = Pelanggan::where('id', $id)->first();
        return response()->json($detailPelanggan);
    }

    public function store(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'kode_pelanggan' => 'required|unique:pelanggans,kode_pelanggan',
            'nama_pelanggan' => 'required',
            'jenis_kelamin'  => 'required',
            'nomor_telepon'  => 'required|unique:pelanggans,nomor_telepon',
            'kode_pos'       => 'max:5',

        ]);
        $pelanggan = Pelanggan::create([
            'kode_pelanggan' => $request->kode_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'nomor_telepon'  => $request->nomor_telepon,
            'email'          => $request->email,
            'alamat'         => $request->alamat,
            'kota'           => $request->kota,
            'kode_pos'       => $request->kode_pos,
            'catatan'        => $request->catatan,
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
            'jenis_kelamin'  => 'required',
            // 'tanggal_lahir'  => '',
            'nomor_telepon'  => 'required|unique:pelanggans,nomor_telepon,' . $id,
            // 'email'          => '',
            // 'alamat'         => '',
            // 'kota'           => '',
            'kode_pos'       => 'max:5',
            // 'catatan'        => '',
        ]);
        $pelanggan = Pelanggan::find($id)->update([
            'kode_pelanggan' => $request->kode_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'nomor_telepon'  => $request->nomor_telepon,
            'email'          => $request->email,
            'alamat'         => $request->alamat,
            'kota'           => $request->kota,
            'kode_pos'       => $request->kode_pos,
            'catatan'        => $request->catatan,
        ]);
    }

    public function destroy($id)
    {
        Pelanggan::destroy($id);
    }
}
