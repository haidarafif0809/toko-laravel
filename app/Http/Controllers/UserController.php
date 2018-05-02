<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

    }
    public function create()
    {

    }
    public function store(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|string|email|max:255']);
        $rahasia     = 'rahasia';
        $tambah_user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => $rahasia]); //ROLE
        $memberRole  = Role::where('name', 'member')->first();
        $tambah_user->attachRole($memberRole);
        return $tambah_user;
    }
    public function show($id)
    {}
    public function edit($id)
    {
        return User::find($id);
    }
    public function update(Request $request, $id)
    {
        //VALIDASI
        $this->validate($request, [
            'name'  => 'required|unique:users,name,' . $id,
            'email' => 'required|string|email|max:255']);
        $edit_user = User::find($id)->update([
            'name'  => $request->name,
            'email' => $request->email]);
        if ($edit_user == true) {return response(200);} else {
            return response(500);
        }
    }
    public function destroy($id)
    {
        return User::destroy($id);
    }
    public function view()
    {
        $user_view = User::where('type', 2)->orderBy('id', 'desc')->paginate(10);
        return response()->json($user_view);
    }
    public function pencarian(Request $request)
    {
        $search    = $request->search;
        $cari_user = User::where('type', 2)
            ->where(function ($query) use ($search) {
                $query->orwhere('nama_pemilik', 'LIKE', '%' . $search . '%')
                    ->orwhere('nama_toko', 'LIKE', '%' . $search . '%')
                    ->orwhere('email', 'LIKE', '%' . $search . '%')
                    ->orwhere('no_telp', 'LIKE', '%' . $search . '%');
            })->paginate(10);

        return $cari_user;
    }

    public function status($id)
    {
        $user = User::find($id);

        if ($user->status == 1) {
            $user->update(['status' => 0]);
            return 0;

        } else {
            $user->update(['status' => 1]);
            return 1;
        }
    }

    public function viewStaff()
    {
        $array      = [];
        $user_staff = User::select('toko_id', 'nama_pemilik', 'email', 'no_telp', 'last_login')->where('type', '!=', 2)->orderBy('id', 'desc')->get();
        foreach ($user_staff as $key) {
            $array[$key->toko_id][] = $key;
        }
        // array_push($array, ['nama' => $key->nama_pemilik]);
        return response()->json($array);
        // return var_export($array);
    }
}
