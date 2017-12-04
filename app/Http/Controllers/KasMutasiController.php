<?php

namespace App\Http\Controllers;

use App\Kas;
use App\KasMutasi;
use Illuminate\Http\Request;

class KasMutasiController extends Controller
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
            'kas_id'     => 'required|exists:kas,id',
            'jumlah'     => 'required|numeric',
            'keterangan' => 'required',
        ]);

        $kas_mutasi = KasMutasi::create([
            'kas_id'     => $request->kas_id,
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

    public function view()
    {

        $kas_mutasi = KasMutasi::paginate(10);

        $kas_mutasi_array = array();
        foreach ($kas_mutasi as $kas_mutasis) {
            $dari_kas = Kas::select('nama_kas')->where('id', $kas_mutasis->dari_kas)->first();
            $ke_kas   = Kas::select('nama_kas')->where('id', $kas_mutasis->ke_kas)->first();
            array_push($kas_mutasi_array, ['nama_kas' => $dari_kas->dari_kas, 'nama_kas' => $ke_kas->ke_kas, 'kas_mutasi' => $kas_mutasis]);
        }
        $respons['current_page']   = $kas_mutasi->currentPage();
        $respons['data']           = $kas_mutasi_array;
        $respons['first_page_url'] = url('/kas-mutasi/view?page=' . $kas_mutasi->firstItem());
        $respons['from']           = 1;
        $respons['last_page']      = $kas_mutasi->lastPage();
        $respons['last_page_url']  = url('/kas-mutasi/view?page=' . $kas_mutasi->lastPage());
        $respons['next_page_url']  = $kas_mutasi->nextPageUrl();
        $respons['path']           = url('/kas-keluar/view');
        $respons['per_page']       = $kas_mutasi->perPage();
        $respons['prev_page_url']  = $kas_mutasi->previousPageUrl();
        $respons['to']             = $kas_mutasi->perPage();
        $respons['total']          = $kas_mutasi->total();

    }

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
    public function dari_kas()
    {
        $dari_kas = Kas::all();
        return response()->json($dari_kas);
    }
    public function ke_kas()
    {
        $ke_kas = Kas::all();
        return response()->json($ke_kas);
    }

    public function destroy($id)
    {
        //
    }
}
