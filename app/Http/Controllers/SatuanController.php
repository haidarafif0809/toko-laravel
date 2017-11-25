<?php

namespace App\Http\Controllers;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Http\Request;
use App\Satuan;

class SatuanController extends Controller
{
   use AuditableTrait;
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

    public function view()
    {
        return Satuan::paginate(10);
    }
    public function search(request $request)
    {
        $search = $request->search;
        return Satuan::where('nama_satuan','LIKE',"%$request->search%")->paginate(10);
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
            'nama_satuan' =>'required|unique:satuans,nama_satuan'
        ]);
        $satuan = Satuan::create(['nama_satuan' => $request->nama_satuan]);
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
        return Satuan::find($id);
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
            'nama_satuan' =>'required|unique:satuans,nama_satuan,'.$id
        ]);
        $satuan = Satuan::find($id)->update(['nama_satuan' => $request->nama_satuan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $hapus = Satuan::destroy($id);
     return $hapus;
 }
}
