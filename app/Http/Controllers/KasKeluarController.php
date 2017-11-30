<?php

namespace App\Http\Controllers;

use App\Kas;
use App\KasKeluar;
use App\KategoriTransaksi;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'kas_id'      => 'required|exists:kas,id',
            'kategori_id' => 'required|exists:kategori_transaksis,id',
            'jumlah'      => 'required|numeric',
            'keterangan'  => 'required',
        ]);

        $kasKeluar = KasKeluar::create([
            'kas_id'      => $request->kas_id,
            'kategori_id' => $request->kategori_id,
            'jumlah'      => $request->jumlah,
            'keterangan'  => $request->keterangan,
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // return KasKeluar::find($id);
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
        $kas_keluar = KasKeluar::paginate(10);

        $kas_keluar_array = array();
        foreach ($kas_keluar as $kas_keluars) {
            $nama_kas                = Kas::select('nama_kas')->where('id', $kas_keluars->kas_id)->first();
            $nama_kategori_transaksi = KategoriTransaksi::select('nama_kategori_transaksi')->where('id', $kas_keluars->kategori_id)->first();
            array_push($kas_keluar_array, ['nama_kas' => $nama_kas->nama_kas, 'kas_keluar' => $kas_keluars, 'nama_kategori_transaksi' => $nama_kategori_transaksi->nama_kategori_transaksi]);
        }

        //DATA PAGINATION
        $respons['current_page']   = $kas_keluar->currentPage();
        $respons['data']           = $kas_keluar_array;
        $respons['first_page_url'] = url('/kas-keluar/view?page=' . $kas_keluar->firstItem());
        $respons['from']           = 1;
        $respons['last_page']      = $kas_keluar->lastPage();
        $respons['last_page_url']  = url('/kas-keluar/view?page=' . $kas_keluar->lastPage());
        $respons['next_page_url']  = $kas_keluar->nextPageUrl();
        $respons['path']           = url('/kas-keluar/view');
        $respons['per_page']       = $kas_keluar->perPage();
        $respons['prev_page_url']  = $kas_keluar->previousPageUrl();
        $respons['to']             = $kas_keluar->perPage();
        $respons['total']          = $kas_keluar->total();
        //DATA PAGINATION

        return $respons;

    }
    public function pencarian(Request $request)
    {
        $cari_kas_keluar = KasKeluar::where('kas_id', 'LIKE', "%$request->search%")->orWhere('jumlah', 'LIKE', "%$request->search%")->paginate(10);
        return $cari_kas_keluar;
    }
    public function kas()
    {
        $kas = Kas::all();
        return response()->json($kas);
    }

    public function kategoriTransaksi()
    {
        $kategoriTransaksi = KategoriTransaksi::all();
        return response()->json($kategoriTransaksi);
    }
}
