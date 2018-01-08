<?php

namespace App\Http\Controllers;

use App\KategoriProduk;
use App\Produk;
use Auth;
use Carbon\Carbon;
use DB;
use Excel;
use File;
use Illuminate\Http\Request;
use Image;
use Validator;

class ProdukController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function index()
    {

    }

    public function tes()
    {
        return Auth::user()->id;
    }

    public function view()
    {
        return Produk::with('satuan')->orderBy('produk_id', 'desc')->paginate(10);
    }

    public function cari(Request $request)
    {
        $produk = Produk::with('satuan')->where('nama_produk', 'LIKE', "%$request->pencarian%")->paginate(10);
        return response()->json($produk);
    }

    public function detail($id)
    {
        $produk = Produk::with('satuan')->where('produk_id', $id)->first();
        return response()->json($produk);
    }

    public function detailSatuanDariProduk($id)
    {
        $produk = Produk::where('produk_id', $id)->first();
        $satuan = Satuan::where('id', $produk->satuans_id)->first();

        return response()->json($satuan);
    }

    public function kategoriProduksId()
    {
        $kategoriProduk = KategoriProduk::all();
        return response()->json($kategoriProduk);
    }

    public function statusJual()
    {
        $status_jual = Produk::select('status_jual')->first();
        return response()->json($status_jual);
    }

    public function detailKategoriProdukDariProduk($id)
    {
        $produk         = Produk::where('produk_id', $id)->first();
        $kategoriProduk = KategoriProduk::where('id', $produk->kategori_produks_id)->first();

        return response()->json($kategoriProduk);
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
        //validate

        if ($request->foto !== null) {
            $this->validate($request, [
                'foto' => 'image64:jpeg,jpg,png|max:3072000',
            ]);

            $imageData = $request->foto;
            $ekstensi  = explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            $fileName  = Carbon::now()->timestamp . '.' . $ekstensi;
            Image::make($request->foto)->save(public_path('foto_produk/') . $fileName);
        } else {
            $this->validate($request, [
                'kode_produk'         => 'required|unique:produks,kode_produk',
                'nama_produk'         => 'required',
                'kategori_produks_id' => 'required|exists:kategori_produks,id',
                'harga_beli'          => 'required|numeric',
                'harga_jual'          => 'required|numeric',
                'status_jual'         => 'required',
            ]);

        }

        // insert
        $produk = Produk::create([
            'kode_produk'         => $request->kode_produk,
            'nama_produk'         => $request->nama_produk,
            'kategori_produks_id' => $request->kategori_produks_id,
            'harga_beli'          => $request->harga_beli,
            'harga_jual'          => $request->harga_jual,
            'satuans_id'          => $request->satuans_id,
            'status_jual'         => $request->status_jual,
            'foto'                => (!empty($fileName) ? $fileName : ''),
        ]);
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
        $produk = Produk::with('satuan')->where('produk_id', $id)->first();
        // return response()->json($produk);
        return $produk;
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
        $produk = Produk::find($id);

        $this->validate($request, [
            'kode_produk'         => 'required',
            'nama_produk'         => 'required',
            'kategori_produks_id' => 'required|exists:kategori_produks,id',
            'harga_beli'          => 'required|numeric',
            'harga_jual'          => 'required|numeric',
            'status_jual'         => 'required',
        ]);

        $arrUpdateProduk = [
            'kode_produk'         => $request->kode_produk,
            'nama_produk'         => $request->nama_produk,
            'kategori_produks_id' => $request->kategori_produks_id,
            'harga_beli'          => $request->harga_beli,
            'harga_jual'          => $request->harga_jual,
            'status_jual'         => $request->status_jual,
        ];

        if ($request->foto !== null) {
            $this->validate($request, [
                'foto' => 'image64:jpeg,jpg,png|max:3072000',
            ]);
            $imageData = $request->foto;
            $ekstensi  = explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];

            $fileName = Carbon::now()->timestamp . '.' . $ekstensi;
            Image::make($request->foto)->save(public_path('foto_produk/') . $fileName);
            if ($produk->foto) {
                $oldImg   = $produk->foto;
                $filePath = public_path('foto_produk/') . $produk->foto;

                try {
                    File::delete($filePath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }

            $arrUpdateProduk['foto'] = $fileName;

        }

        $produk->update($arrUpdateProduk);
        // 'foto' => $fileName,

        if ($produk == true) {
            return response(200);
        } else {
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
        return Produk::destroy($id);
    }

    public function generateExcelTemplate()
    {
        Excel::create('Template Import Produk', function ($excel) {
            // Set the properties
            $excel->setTitle('Template Import Produk')
                ->setCreator('Toko Dasar')
                ->setCompany('Toko Dasar')
                ->setDescription('Template Import Produk di Aplikasi Toko Dasar');
            $excel->sheet('Data Produk', function ($sheet) {
                $row = 1;
                $sheet->row($row, [
                    'Kode Produk',
                    'Nama Produk',
                    'Kategori Produk',
                    'Harga Beli',
                    'Harga Jual',
                    'Bisa Dijual',
                ]);
            });
        })->export('xlsx');
    }

    public function importExcel(Request $request)
    {
        // validasi untuk memastikan file yang diupload adalah excel
        $this->validate($request, ['excel' => 'required|mimes:xls,xlsx']);
        // ambil file yang baru diupload
        $excel = $request->file('excel');
        // baca sheet pertama
        $excels = Excel::selectSheetsByIndex(0)->load($excel, function ($reader) {
            // options, jika ada
        })->get();
        // rule untuk validasi setiap row pada file excel

        $rowRules = [
            'Kode Produk'     => 'required|unique:produks,kode_produk',
            'Nama Produk'     => 'required',
            'Kategori Produk' => 'required|exists:kategori_produks,id',
            'Harga Beli'      => 'required|numeric',
            'Harga Jual'      => 'required|numeric',
            'Bisa Dijual'     => 'required',
        ];
        // Catat semua id buku baru
        // ID ini kita butuhkan untuk menghitung total buku yang berhasil diimport
        $produk_id = [];

        // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
            $validator = Validator::make($row->toArray(), $rowRules);

            // Variable array kosong untuk menampung pesan error
            $errorMsg = [];
            // Membuang spasi dan mengubah huruf menjadi lowercase (huruf kecil)
            $bisaDijual = trim(strtolower($row['bisa_dijual']));
            if ($bisaDijual !== 'ya' && $bisaDijual !== 'tidak') {
                $errorMsg['pesan'] = 'Nilai dari kolom Bisa Dijual hanya boleh berisi ya atau tidak';
                return response()->json($errorMsg);
            }

            /*
            |---------------------------------------------------------------------------
            | Mengecek nama kategori produk
            |---------------------------------------------------------------------------
            |
            | Disini kita cek apakah kategori produk yang user inputkan didalam
            | Excel ada atau belum pada Master Data Kategori Produk.
            | Jika ternyata tidak ada maka akan dibuatkan yang baru dengan nama
            | sesuai dengan yang diinputkan pada Excel
             */

            /* Begin Cek Kategori Produk */

            // Membuat variable array kosong
            $dataKategoriProduk = [];

            // Mengambil semua nama kategori produk pada tabel kategori_produks
            // dan kemudian mengubahnya menjadi associative array
            $namaKategoriProduk = KategoriProduk::select('nama_kategori_produk')->get();
            $namaKategoriProduk = json_decode($namaKategoriProduk, true);

            // Mengambil semua id kategori produk pada tabel kategori_produks
            // dan kemudian mengubahnya menjadi associative array
            $idKategoriProduk = KategoriProduk::select('id')->get();
            $idKategoriProduk = json_decode($idKategoriProduk, true);

            $importNamaKategoriProduk = strtolower($row['kategori_produk']);

            // Memasukkan data ke variable array kosong
            // yang telah dibuat diatas
            array_push($dataKategoriProduk, $namaKategoriProduk, $idKategoriProduk);

            // data nama dan id kategori produk "nama => id"
            $arrNamaIdKategoriProduk = [];

            // Mengisi variable array $arrNamaIdKategoriProduk dengan nama KategoriProduk sebagai index
            // dan id KategoriProduk sebagai value
            for ($i = 0; $i < count($dataKategoriProduk[1]); $i++) {
                $arrNamaIdKategoriProduk[$dataKategoriProduk[0][$i]['nama_kategori_produk']] = $dataKategoriProduk[1][$i]['id'];
            }

            // Mengubah semua key (nama KategoriProduk) menjadi huruf kecil
            $arrNamaIdKategoriProduk = array_change_key_case($arrNamaIdKategoriProduk, CASE_LOWER);

            // Membuat variable array kosong untuk menampung nama kategori produk
            $arrayNamaKategoriProduk = [];
            // Memasukkan data nama KategoriProduk ke variable $arrayNamaKategoriProduk
            foreach ($namaKategoriProduk as $namaKP) {
                array_push($arrayNamaKategoriProduk, $namaKP['nama_kategori_produk']);
            }
            // Membuat value dari $arrayNamaKategoriProduk menjadi huruf kecil semua
            $arrayNamaKategoriProduk = array_map('strtolower', $arrayNamaKategoriProduk);

            /* End Cek Kategori Produk*/

            if (in_array($importNamaKategoriProduk, $arrayNamaKategoriProduk)) {

                // buat produk baru
                $produk = Produk::create([
                    'kode_produk'         => $row['kode_produk'],
                    'nama_produk'         => $row['nama_produk'],
                    'kategori_produks_id' => $arrNamaIdKategoriProduk[$importNamaKategoriProduk],
                    'harga_beli'          => $row['harga_beli'],
                    'harga_jual'          => $row['harga_jual'],
                    'bisa_dijual'         => $row['bisa_dijual'],
                ]);

            } else {
                // Membuat kategori produk baru
                $kategori_produk = KategoriProduk::create([
                    // Membuat setiap awal kata pada nama aplikasi menggunakan huruf kapital
                    'nama_kategori_produk' => ucwords($importNamaKategoriProduk),
                ]);

                // Mengambil data terbaru dari master data kategori produk
                $idKategoriProdukTerbaru = DB::table('kategori_produks')->orderBy('id', 'desc')->limit(1)->first();

                // Membuat produk baru
                $produk = Produk::create([
                    'kode_produk'         => $row['kode_produk'],
                    'nama_produk'         => $row['nama_produk'],
                    'kategori_produks_id' => $idKategoriProdukTerbaru->id,
                    'harga_beli'          => $row['harga_beli'],
                    'harga_jual'          => $row['harga_jual'],
                    'bisa_dijual'         => $row['bisa_dijual'],
                ]);}

            // catat id dari buku yang baru dibuat
            // array_push($produk_id, $produk->produk_id);

        }

        // Ambil semua produk yang baru dibuat
        $produks = Produk::whereIn('produk_id', $produk_id)->get();
    }
}
