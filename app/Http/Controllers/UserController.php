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
        $user_view = User::orderBy('id', 'desc')->paginate(10);
        return response()->json($user_view);
    }
    public function pencarian(Request $request)
    {
        $cari_user = User::where('name', 'LIKE', "%$request->search%")->orWhere('email', 'LIKE', "%$request->search%")->paginate(10);
        return $cari_user;
    }
}
