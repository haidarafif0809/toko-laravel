<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;

class StafTokoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
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
            'nama_pemilik' => 'required',
            'email'        => 'required|email|unique:users,email',
            'no_telp'      => 'required',
            'password'     => 'required|string|min:6',

        ]);
        $password    = 'rahasia';
        $type        = 2;
        $tambah_user = User::create([
            'type'         => $type,
            'toko_id'      => Auth::user()->toko_id,
            'nama_pemilik' => $request->nama_pemilik,
            'password'     => $request->password,
            'email'        => $request->email,
            'no_telp'      => $request->no_telp,
        ]);
        $memberRole = Role::where('name', 'member')->first();
        $tambah_user->attachRole($memberRole);
        $tambah_user->sendVerificationStaff();
        return $tambah_user;
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
        return User::find($id);
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
            'nama_pemilik' => 'required',
            'email'        => 'required|email|unique:users,email,' . $id,
            'no_telp'      => 'required',

        ]);
        User::find($id)->update([
            'nama_pemilik' => $request->nama_pemilik,
            'email'        => $request->email,
            'no_telp'      => $request->no_telp,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return User::destroy($id);
    }

    public function view()
    {
        return User::where('toko_id', Auth::user()->toko_id)->where('type', 2)->orderBy('id', 'desc')->paginate(10);
    }

    public function search(Request $request)
    {
        $user = User::where('toko_id', Auth::user()->toko_id)->where('nama_pemilik', 'LIKE', "%$request->search%")->paginate(10);
        return response()->json($user);
    }

}
