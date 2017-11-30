<?php

namespace App\Http\Controllers;

use App\Kas;
use App\KasMasuk;
use App\KategoriTransaksi;
use Illuminate\Http\Request;

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
            'kas_id'      => 'required|exists:kas,id',
            'kategori_id' => 'required|exists:kategori_transaksis,id',
            'jumlah'      => 'required|numeric',
            'keterangan'  => 'required',
        ]);

        $kas_masuk = KasMasuk::create([
            'kas_id'      => $request->kas_id,
            'kategori_id' => $request->kategori_id,
            'jumlah'      => $request->jumlah,
            'keterangan'  => $request->keterangan,
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
        return KasMasuk::with('kas')->find($id);

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
            'kas_id'      => 'required|exists:kas,id',
            'kategori_id' => 'required|exists:kategori_transaksis,id',
            'jumlah'      => 'required|numeric',
            'keterangan'  => 'required',
        ]);
        $update = KasMasuk::find($id)->update([
            'kas_id'      => $request->kas_id,
            'kategori_id' => $request->kategori_id,
            'jumlah'      => $request->jumlah,
            'keterangan'  => $request->keterangan,
        ]);
        if ($update == true) {
            return response(200);
        } else {
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
        $destroy = KasMasuk::destroy($id);
        return $destroy;
    }

    public function view()
    {
        $kas_masuk = KasMasuk::paginate(10);

        $kas_masuk_array = array();
        foreach ($kas_masuk as $kas_masuks) {
            $nama_kategori_transaksi = KategoriTransaksi::select('nama_kategori_transaksi')->where('id', $kas_masuks->kategori_id)->first();
            $nama_kas                = Kas::select('nama_kas')->where('id', $kas_masuks->kas_id)->first();
            array_push($kas_masuk_array, ['nama_kas' => $nama_kas->nama_kas, 'kas_masuk' => $kas_masuks, 'nama_kategori_transaksi' => $nama_kategori_transaksi->nama_kategori_transaksi]);
        }

        //DATA PAGINATION
        $respons['current_page']   = $kas_masuk->currentPage();
        $respons['data']           = $kas_masuk_array;
        $respons['first_page_url'] = url('/kasMasuk/view?page=' . $kas_masuk->firstItem());
        $respons['from']           = 1;
        $respons['last_page']      = $kas_masuk->lastPage();
        $respons['last_page_url']  = url('/kasMasuk/view?page=' . $kas_masuk->lastPage());
        $respons['next_page_url']  = $kas_masuk->nextPageUrl();
        $respons['path']           = url('/kasMasuk/view');
        $respons['per_page']       = $kas_masuk->perPage();
        $respons['prev_page_url']  = $kas_masuk->previousPageUrl();
        $respons['to']             = $kas_masuk->perPage();
        $respons['total']          = $kas_masuk->total();
        //DATA PAGINATION

        return $respons;}

    public function search(Request $request)
    {
        $search = KasMasuk::with('kas')->where("kas_id", "LIKE", "%$request->pencarian")->paginate(10);
        return $search;
    }

    public function kas()
    {
        $kas = Kas::all();
        return response()->json($kas);
    }

    public function kategoriTransaksi()
    {
        $kategori_transaksi = KategoriTransaksi::all();
        return response()->json($kategori_transaksi);
    }

    public function dataTransaksi($id)
    {
        $kas_masuk          = KasMasuk::where('kas_masuk_id', $id)->first();
        $kategori_transaksi = KategoriTransaksi::where('id', $kas_masuk->kategori_id)->first();
        return response()->json($kategori_transaksi);
    }

    public function dataKas($id)
    {
        $kas_masuk = KasMasuk::where('kas_masuk_id', $id)->first();
        $data_kas  = Kas::where('id', $kas_masuk->kas_masuk_id)->first();
        return response()->json($data_kas);
    }
}
