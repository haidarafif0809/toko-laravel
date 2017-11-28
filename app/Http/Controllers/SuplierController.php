<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suplier;

class SuplierController extends Controller
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

    public function search(Request $request)
    {
        $suplier = Suplier::where('nama_suplier', 'LIKE', "%$request->pencarian%")->orWhere('alamat_suplier','LIKE',"%$request->pencarian%")->orWhere('no_telp_suplier','LIKE',"%$request->pencarian%")->paginate(10);
        return response()->json($suplier);
    }

    public function view()
    {
        return Suplier::paginate(10);
    }

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
            'nama_suplier'     => 'required',
            'alamat_suplier'     => 'max:225',
            'no_telp_suplier'     => 'required|unique:supliers,no_telp_suplier'
        ]);
        $tambah_suplier = Suplier::create([
            'nama_suplier' =>$request->nama_suplier,  
            'alamat_suplier' =>$request->alamat_suplier,        
            'no_telp_suplier' =>$request->no_telp_suplier        
        ]);
        return $tambah_suplier;
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
        return Suplier::find($id);
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
            'nama_suplier'     => 'required',
            'alamat_suplier'   => 'max:225',
            'no_telp_suplier'  => 'max:225'
        ]);

        $suplier =   Suplier::find($id)->update([
            'nama_suplier' =>$request->nama_suplier,
            'alamat_suplier' =>$request->alamat_suplier,
            'no_telp_suplier' =>$request->no_telp_suplier
        ]);
        if ($suplier == true) {
            return response(200);
        }
        else {
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
        //
        $hapus_suplier = Suplier::destroy($id);
        return $hapus_suplier;
    }
}
