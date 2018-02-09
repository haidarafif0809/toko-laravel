<?php

namespace App\Http\Controllers;

use App\Toko;
use App\User;
use Auth;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Image;
use Indonesia;

class ProfileTokoController extends Controller
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
        // $provinsi   = Indonesia::allProvinces();
        $user_login = Toko::find($id);
        if ($user_login->id != $id) {
            Auth::logout();
            return response()->view('error.403');
        } else {
            $this->validate($request, [
                'nama_toko'    => 'required',
                'nama_pemilik' => 'required',
                'email'        => 'required|string|email|max:255|unique:tokos,email,' . $id,
                'no_telp'      => 'required',
                'provinsi'     => 'required',
                'kabupaten'    => 'required',
                'alamat'       => 'required',
            ]);
            $user_login->update([
                'nama_toko'        => $request->nama_toko,
                'nama_pemilik'     => $request->nama_pemilik,
                'email'            => $request->email,
                'no_telp'          => $request->no_telp,
                'provinsi'         => $request->provinsi,
                'kabupaten'        => $request->kabupaten,
                'alamat'           => $request->alamat,
                'prefix_member_id' => $request->prefix_member_id,
            ]);
        }if ($request->foto === null) {

            return;

        } else {

            $this->validate($request, [
                'foto' => 'image64:jpeg,jpg,png|max:3072000',
            ]);
            $imageData = $request->foto;
            $ekstensi  = explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];

            $fileName = Carbon::now()->timestamp . '.' . $ekstensi;
            Image::make($request->foto)->save(public_path('logo/') . $fileName);
            if ($user_login->foto) {
                $oldImg   = $user_login->foto;
                $filePath = public_path('logo/') . $user_login->foto;

                try {
                    File::delete($filePath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }

            $user_login->foto = $fileName;
            $user_login->save();

        }

        // 'foto' => $fileName,

        if ($user_login == true) {
            return response(200);
        } else {
            return response(500);
        }
    }

    public function proses_ubah_profil_toko(Request $request)
    {

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
    }

    public function view()
    {
        $profile_toko       = Toko::with('user')->where('id', Auth::user()->toko_id)->paginate(10);
        $profile_toko_array = array();

        foreach ($profile_toko as $profile_tokos) {
            $user = User::select('last_login')->where('toko_id', $profile_tokos->id)->first();

            if ($profile_tokos->provinsi == null) {
                $provinsi  = '';
                $kabupaten = '';
            } else {
                $provinsi  = Indonesia::findProvince($profile_tokos->provinsi);
                $kabupaten = Indonesia::findCity($profile_tokos->kabupaten);
            }

            array_push($profile_toko_array, ['last_login' => $user->last_login, 'profileToko' => $profile_tokos, 'provinsi' => $provinsi, 'kabupaten' => $kabupaten]);
        }

        //DATA PAGINATION
        $respons['current_page']   = $profile_toko->currentPage();
        $respons['data']           = $profile_toko_array;
        $respons['first_page_url'] = url('/profile-toko/view?page=' . $profile_toko->firstItem());
        $respons['from']           = 1;
        $respons['last_page']      = $profile_toko->lastPage();
        $respons['last_page_url']  = url('/profile-toko/view?page=' . $profile_toko->lastPage());
        $respons['next_page_url']  = $profile_toko->nextPageUrl();
        $respons['path']           = url('/profile-toko/view');
        $respons['per_page']       = $profile_toko->perPage();
        $respons['prev_page_url']  = $profile_toko->previousPageUrl();
        $respons['to']             = $profile_toko->perPage();
        $respons['total']          = $profile_toko->total();
        //DATA PAGINATION
        return response()->json($respons);
    }
    public function provinsi()
    {
        $alamat = Indonesia::allProvinces();
        return response()->json($alamat);
    }

    public function kabupaten($id, $type)
    {
        // proses loding data kabupaten sesuai provinsi
        switch ($type) {
            case 'kabupaten':
                $kabupaten = Indonesia::allCities()->where('province_id', $id);
                return response()->json($kabupaten);
                break;
        }
    }
}
