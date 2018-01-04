<?php

namespace App\Http\Controllers;

use App\Gerai;
use Illuminate\Http\Request;
use App\User;
use Auth;
class GeraiController extends Controller
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
    public function view()
    {

        return Gerai::where('toko_id', Auth::user()->toko_id)->orderBy('id', 'desc')->paginate(10);

    }

    public function search(Request $request)
    {
        $search_gerai = Gerai::where('toko_id', Auth::user()->toko_id)
        ->where(function ($query) use ($request) {
            $query->orwhere('nama_gerai', 'LIKE', "%$request->pencarian%")
            ->orwhere('alamat_gerai', 'LIKE', "%$Request->pencarian%")
            ->orwhere('no_telepon_a', 'LIKE', "%$Request->pencarian%")
            ->orwhere('no_telepon_b', 'LIKE', "%$Request->pencarian%")
            ->orwhere('notes', 'LIKE', "%$Request->pencarian%")
            ->orwhere('nama_pajak', 'LIKE', "%$Request->pencarian%")
            ->orwhere('rasio', 'LIKE', "%$Request->pencarian%")
            ->orwhere('meja', 'LIKE', "%$Request->pencarian%");
        })->orderBy('gerai_id', 'desc')->paginate(10);

        return response()->json($search_gerai);
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
            'nama_gerai'   => 'required',
            'no_telepon_a' => 'max:13|unique:gerais,no_telepon_a',
            'no_telepon_b' => 'max:13|unique:gerais,no_telepon_b',
        ]);
        $Gerai = Gerai::create([
         'toko_id'    => Auth::user()->toko_id,
         'nama_gerai'   => $request->nama_gerai,
         'alamat_gerai' => $request->alamat_gerai,
         'kota'         => $request->kota,
         'no_telepon_a' => $request->no_telepon_a,
         'no_telepon_b' => $request->no_telepon_b,
         'notes'        => $request->notes,
         'nama_pajak'   => $request->nama_pajak,
         'rasio'        => $request->rasio,
         'meja'         => $request->meja,
     ]);

        return response()->json($Gerai);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Gerai::find($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_gerai'   => 'required',
            'no_telepon_a' => 'max:13',
            'no_telepon_b' => 'max:13',
        ]);

        $gerai = Gerai::find($id)->update([
            'nama_gerai'   => $request->nama_gerai,
            'alamat_gerai' => $request->alamat_gerai,
            'kota'         => $request->kota,
            'no_telepon_a' => $request->no_telepon_a,
            'no_telepon_b' => $request->no_telepon_b,
            'notes'        => $request->notes,
            'nama_pajak'   => $request->nama_pajak,
            'rasio'        => $request->rasio,
            'meja'         => $request->meja,
        ]);
        if ($gerai == true) {
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
        $hapus_gerai = Gerai::destroy($id);
        return $hapus_gerai;
    }
}
