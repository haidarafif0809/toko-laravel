<?php

namespace App\Http\Controllers;

use App\Kas;
use App\KelolaKas;
use App\User;
use Auth;
use Illuminate\Http\Request;

class KelolaKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

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
            'type'       => 'required',
            'jumlah'     => 'required',
            'keterangan' => 'required',
        ]);

        $kelola_kas = KelolaKas::create([
            'toko_id'    => Auth::user()->toko_id,
            'type'       => $request->type,
            'jumlah'     => $request->jumlah,
            'keterangan' => $request->keterangan,
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
        return KelolaKas::find($id);

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
            'type'       => 'required',
            'jumlah'     => 'required',
            'keterangan' => 'required',
        ]);
        $update = KelolaKas::find($id)->update([
            'type'       => $request->type,
            'jumlah'     => $request->jumlah,
            'keterangan' => $request->keterangan,
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
        $destroy = KelolaKas::destroy($id);
        return $destroy;
    }

    public function view()
    {
        $array            = [];
        $tokoIdUserOnline = Auth::user()->toko_id;
        $kelola_kas       = KelolaKas::where('toko_id', $tokoIdUserOnline)->orderBy('kelola_kas_id', 'desc')->paginate(10);
        $jumlahKasMasuk   = KelolaKas::select('jumlah')->where([
            ['type', '=', 1],
            ['toko_id', '=', $tokoIdUserOnline],
        ])->get();
        $jumlahKasMasuk = json_decode($jumlahKasMasuk, true);
        $arrayJumlah    = [];
        foreach ($jumlahKasMasuk as $key => $val) {
            $arrayJumlahKasMasuk[] = $val['jumlah'];
        }
        $totalKasMasuk = array_sum($arrayJumlahKasMasuk);

        $jumlahKasKelu = KelolaKas::select('jumlah')->where([
            ['type', '=', 2],
            ['toko_id', '=', $tokoIdUserOnline],
        ])->get();
        $jumlahKasKelu      = json_decode($jumlahKasKelu, true);
        $arrayJumlahKasKelu = [];
        foreach ($jumlahKasKelu as $key => $val) {
            $arrayJumlahKasKelu[] = $val['jumlah'];
        }
        $totalKasKelu = array_sum($arrayJumlahKasKelu);

        $hasil1            = $totalKasMasuk - $totalKasKelu;
        $hasil2            = "Rp" . number_format($hasil1, 2, ',', '.');
        $array['jumlah']   = $hasil2;
        $array['data_kas'] = $kelola_kas;

        // $kelola_kas_array = array();
        // foreach ($kelola_kas as $kelola_kass) {
        //     $nama_kategori_transaksi = KategoriTransaksi::select('nama_kategori_transaksi')->where('id', $kelola_kass->kategori_id)->first();
        //     $nama_kas                = Kas::select('nama_kas')->where('id', $kelola_kass->kas_id)->first();
        //     array_push($kelola_kas_array, ['nama_kas' => $nama_kas->nama_kas, 'kelola_kas' => $kelola_kass, 'nama_kategori_transaksi' => $nama_kategori_transaksi->nama_kategori_transaksi]);
        // }

        // //DATA PAGINATION
        // $respons['current_page']   = $kelola_kas->currentPage();
        // $respons['data']           = $kelola_kas_array;
        // $respons['first_page_url'] = url('/KelolaKas/view?page=' . $kelola_kas->firstItem());
        // $respons['from']           = 1;
        // $respons['last_page']      = $kelola_kas->lastPage();
        // $respons['last_page_url']  = url('/KelolaKas/view?page=' . $kelola_kas->lastPage());
        // $respons['next_page_url']  = $kelola_kas->nextPageUrl();
        // $respons['path']           = url('/KelolaKas/view');
        // $respons['per_page']       = $kelola_kas->perPage();
        // $respons['prev_page_url']  = $kelola_kas->previousPageUrl();
        // $respons['to']             = $kelola_kas->perPage();
        // $respons['total']          = $kelola_kas->total();
        // //DATA PAGINATION

        return response()->json($array);
    }

    public function search(Request $request)
    {
        $search = KelolaKas::where('toko_id', Auth::user()->toko_id)
            ->where(function ($query) use ($request) {
                $query->orwhere('type', 'LIKE', "%$request->pencarian%")
                    ->orWhere('jumlah', 'LIKE', "%$request->pencarian%")
                    ->orWhere('keterangan', 'LIKE', "%$request->pencarian%");
            })->orderBy('kelola_kas_id', 'desc')->paginate(10);

        return response()->json($search);
    }

    public function kas()
    {
        $kas = Kas::all();
        return response()->json($kas);
    }

    // public function kategoriTransaksi()
    // {
    //     $kategori_transaksi = KategoriTransaksi::all();
    //     return response()->json($kategori_transaksi);
    // }

    public function stafAktif()
    {
        $user = User::all();
        return response()->json($user);

    }
}
