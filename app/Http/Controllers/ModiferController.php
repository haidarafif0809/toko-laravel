<?php

namespace App\Http\Controllers;

use App\Modifier:
use Illuminate\Http\Request;

class ModiferController extends Controller
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
            'nama_modifier'  => 'nullable|unique:modifier,nama_modifier',
            'nama_tampilan'  => 'nullable|unique:modifier,nama_tampilan',
            'harga_modifier' => 'nullable|numeric',
        ]);
        
        Modifier::create([
            'nama_modifier'  => $request->nama_modifier,
            'nama_tampilan'  => $request->nama_tampilan,
            'harga_modifier' => $request->harga_modifier,
        ]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
