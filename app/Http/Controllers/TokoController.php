<?php

namespace App\Http\Controllers;

use App\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
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
    public function view()
    {
        $toko = Toko::select('tokos.id AS id_toko', 'tokos.nama_toko AS nama_tokos', 'tokos.nama_pemilik AS nama_pemilik', 'tokos.email AS email', 'tokos.no_telp AS no_telp', 'tokos.created_at AS created_at', 'users.id AS id_user', 'users.status AS statusToko')->leftJoin('users', 'tokos.id', '=', 'users.toko_id')->where('type', 1)->orderBy('tokos.id', 'desc')->paginate(10);
        return response()->json($toko);
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
        //
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
        $toko = Toko::find($id);
        return response()->json($toko);
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
            'nama_toko'    => 'required',
            'nama_pemilik' => 'required',
            'email'        => 'required|email|unique:tokos,email,' . $id,
            'no_telp'      => 'required',
        ]);
        $update_toko = Toko::find($id)->update([
            'nama_toko'    => $request->nama_toko,
            'nama_pemilik' => $request->nama_pemilik,
            'email'        => $request->email,
            'no_telp'      => $request->no_telp,
        ]);
        if ($update_toko == true) {return response(200);} else {return response(500);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Toko::destroy($id);
        return $delete;
    }
    public function search(Request $request)
    {
        $pencarian_toko = Toko::select('tokos.nama_toko AS nama_tokos', 'tokos.nama_pemilik AS nama_pemilik', 'tokos.email AS email', 'tokos.no_telp AS no_telp', 'tokos.created_at AS created_at')->leftJoin('users', 'tokos.id', '=', 'users.toko_id')->where('tokos.nama_pemilik', 'LIKE', "%$request->pencarian%")->orWhere('tokos.email', 'LIKE', "%$request->pencarian%")->orWhere('tokos.nama_toko', 'LIKE', "%$request->pencarian%")->paginate(10);
        return response()->json($pencarian_toko);
    }
}
