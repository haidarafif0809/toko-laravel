<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kas;

class KasController extends Controller
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
        $this->validate($request,[
            'kode_kas' => 'required|unique:kas,kode_kas',
            'nama_kas' => 'required'
        ]);
        $tambah_kas = Kas::create(['kode_kas'=>$request->kode_kas,'nama_kas'=>$request->nama_kas]);
        return $tambah_kas;
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return Kas::find($id);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'kode_kas' => 'required|unique:kas,kode_kas,'.$id,
            'nama_kas' => 'required'
        ]);

        $update_kas = Kas::find($id)->update([
            'kode_kas' =>$request->kode_kas,
            'nama_kas' =>$request->nama_kas
        ]);
        if ($update_kas == true) 
            {return response(200);}
        else{return response(500);}
    }

    public function destroy($id)
    {
        return Kas::destroy($id);
    }

    public function view()
    {
        $index_kas = Kas::paginate(10);
        return $index_kas;
    }

    public function pencarian(Request $request)
    {
        $cari_kas = Kas::where('kode_kas','LIKE',"%$request->search%")->orWhere('nama_kas','LIKE',"%$request->search%")->paginate(10);
        return $cari_kas;
    }
}
