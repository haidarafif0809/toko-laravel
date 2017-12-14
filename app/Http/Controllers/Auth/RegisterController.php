<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Role;
use App\Toko;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_toko'    => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'no_telp'      => 'required|string|max:12|unique:users',
            'password'     => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $toko = Toko::create([
            'nama_toko'    => $data['nama_toko'],
            'nama_pemilik' => $data['nama_pemilik'],
            'email'        => $data['email'],
            'no_telp'      => $data['no_telp'],
        ]);
        $user = User::create([
            'toko_id'      => $toko->id,
            'nama_pemilik' => $toko->nama_pemilik,
            'email'        => $toko->email,
            'no_telp'      => $toko->no_telp,
            'password'     => $data['password'],
        ]);
        $memberRole = Role::where('name', 'member')->first();
        $user->attachRole($memberRole);
        return $user;

    }
}
