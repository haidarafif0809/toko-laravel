<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Role;
use App\Toko;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $this->middleware('user-should-verified');

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
        // type 1 = user toko, 2 = staf toko
        $type = 1;
        $toko = Toko::create([
            'nama_toko'    => $data['nama_toko'],
            'nama_pemilik' => $data['nama_pemilik'],
            'email'        => $data['email'],
            'no_telp'      => $data['no_telp'],
        ]);
        $user = User::create([
            'type'         => $type,
            'toko_id'      => $toko->id,
            'nama_toko'    => $toko->nama_toko,
            'nama_pemilik' => $toko->nama_pemilik,
            'email'        => $toko->email,
            'no_telp'      => $toko->no_telp,
            'password'     => $data['password'],
        ]);
        $memberRole = Role::where('name', 'member')->first();
        $user->attachRole($memberRole);
        $user->sendVerification();
        return $user;

    }

    public function verify(Request $request, $token)
    {

        $email = $request->get('email');
        $user  = User::where('verification_token', $token)->where('email', $email)->first();
        if ($user) {
            $user->verify();
            Session::flash("flash_notification", [
                "level"   => "success",
                "message" => "Berhasil melakukan verifikasi.",
            ]);
            Auth::login($user);
        }
        return redirect('/home');

    }
}
