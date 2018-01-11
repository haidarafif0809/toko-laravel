<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Excel;
use File;
use Validator;

class PelangganController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function view()
    {
        return Pelanggan::where('toko_id', Auth::user()->toko_id)->orderBy('created_at', 'desc')->paginate(10);
    }
    public function search(Request $request)
    {
        $cari_pelanggan = Pelanggan::where('toko_id', Auth::user()->toko_id)
        ->where(function ($query) use ($request) {
            $query->orwhere('kode_pelanggan', 'LIKE', "%$request->search%")
            ->orWhere('nama_pelanggan', 'LIKE', "%$request->search%")
            ->orWhere('nomor_telepon', 'LIKE', "%$request->search%")
            ->orWhere('email', 'LIKE', "%$request->search%");
        })->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($cari_pelanggan);
    }

    public function detail($id)
    {
        $detailPelanggan = Pelanggan::where('id', $id)->first();
        return response()->json($detailPelanggan);
    }

    public function store(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'nama_pelanggan' => 'required',
            'jenis_kelamin'  => 'required',
            'nomor_telepon'  => 'required|max:13|unique:pelanggans,nomor_telepon',
            'kode_pos'       => 'max:5',

        ]);
        $pelanggan = Pelanggan::create([
            'toko_id'    => Auth::User()->toko_id,
            'kode_pelanggan' => $request->kode_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'nomor_telepon'  => $request->nomor_telepon,
            'email'          => $request->email,
            'alamat'         => $request->alamat,
            'kota'           => $request->kota,
            'kode_pos'       => $request->kode_pos,
            'catatan'        => $request->catatan,
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return Pelanggan::find($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'kode_pelanggan' => 'required|unique:pelanggans,kode_pelanggan,' . $id,
            'nama_pelanggan' => 'required',
            'jenis_kelamin'  => 'required',
            // 'tanggal_lahir'  => '',
            'nomor_telepon'  => 'required|max:13|unique:pelanggans,nomor_telepon,' . $id,
            // 'email'          => '',
            // 'alamat'         => '',
            // 'kota'           => '',
            'kode_pos'       => 'max:5',
            // 'catatan'        => '',
        ]);
        $pelanggan = Pelanggan::find($id)->update([
            'kode_pelanggan' => $request->kode_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'nomor_telepon'  => $request->nomor_telepon,
            'email'          => $request->email,
            'alamat'         => $request->alamat,
            'kota'           => $request->kota,
            'kode_pos'       => $request->kode_pos,
            'catatan'        => $request->catatan,
        ]);
    }

    public function destroy($id)
    {
        Pelanggan::destroy($id);
    }

    public function generateExcelTemplate()
    {
        Excel::create('Template Import Pelanggan', function ($excel) {
            // Set the properties
            $excel->setTitle('Template Import Pelanggan')
            ->setCreator('Toko Dasar')
            ->setCompany('Toko Dasar')
            ->setDescription('Template Import Pelanggan di Aplikasi Toko Dasar');
            $excel->sheet('Data Pelanggan', function ($sheet) {
                $row = 1;
                $sheet->row($row, [
                    'Nama Pelanggan',
                    'Jenis Kelamin',
                    'Tanggal Lahir',
                    'Nomor Telepon',
                    'Email',
                    'Alamat',
                    'Kota',
                    'Kode Pos',
                    'Catatan'
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
            'Nama Pelanggan'  => 'required',
            'Jenis Kelamin'   => 'required',
            'Tanggal Lahir'   => '',
            'Nomor Telepon'   =>'required|max:13|unique:pelanggans,nomor_telepon' ,
            'Email'           => '',
            'Alamat'          => '',
            'Kota'            => '',
            'Kode Pos'        => 'max:5',
            'Catatan'         => '',
        ];
        // Catat semua id buku baru
        // ID ini kita butuhkan untuk menghitung total buku yang berhasil diimport
        $pelanggan_id = [];

        // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
            $validator = Validator::make($row->toArray(), $rowRules);

            // Variable array kosong untuk menampung pesan error
            // $errorMsg = [];
            // Membuang spasi dan mengubah huruf menjadi lowercase (huruf kecil)
            // $bisaDijual = trim(strtolower($row['bisa_dijual']));
            // if ($bisaDijual !== 'ya' && $bisaDijual !== 'tidak') {
            //     $errorMsg['pesan'] = 'Nilai dari kolom Bisa Dijual hanya boleh berisi ya atau tidak';
            //     return response()->json($errorMsg);
            // }

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
            // $dataKategoriProduk = [];

            // Mengambil semua nama kategori produk pada tabel kategori_produks
            // dan kemudian mengubahnya menjadi associative array
            // $namaKategoriProduk = KategoriProduk::select('nama_kategori_produk')->get();
            // $namaKategoriProduk = json_decode($namaKategoriProduk, true);

            // Mengambil semua id kategori produk pada tabel kategori_produks
            // dan kemudian mengubahnya menjadi associative array
            // $idKategoriProduk = KategoriProduk::select('id')->get();
            // $idKategoriProduk = json_decode($idKategoriProduk, true);

            // $importNamaKategoriProduk = strtolower($row['kategori_produk']);

            // Memasukkan data ke variable array kosong
            // yang telah dibuat diatas
            // array_push($dataKategoriProduk, $namaKategoriProduk, $idKategoriProduk);

            // data nama dan id kategori produk "nama => id"
            // $arrNamaIdKategoriProduk = [];

            // Mengisi variable array $arrNamaIdKategoriProduk dengan nama KategoriProduk sebagai index
            // dan id KategoriProduk sebagai value
            // for ($i = 0; $i < count($dataKategoriProduk[1]); $i++) {
                // $arrNamaIdKategoriProduk[$dataKategoriProduk[0][$i]['nama_kategori_produk']] = $dataKategoriProduk[1][$i]['id'];
            // }

            // Mengubah semua key (nama KategoriProduk) menjadi huruf kecil
            // $arrNamaIdKategoriProduk = array_change_key_case($arrNamaIdKategoriProduk, CASE_LOWER);

            // Membuat variable array kosong untuk menampung nama kategori produk
            // $arrayNamaKategoriProduk = [];
            // Memasukkan data nama KategoriProduk ke variable $arrayNamaKategoriProduk
            // foreach ($namaKategoriProduk as $namaKP) {
                // array_push($arrayNamaKategoriProduk, $namaKP['nama_kategori_produk']);
            // }
            // Membuat value dari $arrayNamaKategoriProduk menjadi huruf kecil semua
            // $arrayNamaKategoriProduk = array_map('strtolower', $arrayNamaKategoriProduk);

            /* End Cek Kategori Produk*/

            // if (in_array($importNamaKategoriProduk, $arrayNamaKategoriProduk)) {

            //Skip baris ini jadi tidak valid , langsung ke baris selajutnya
            if ($validator->fails()) continue;
                // buat produk baru
            $pelanggan = Pelanggan::create([
                'nama_pelanggan'         => $row['nama_pelanggan'],
                'jenis_kelamin'         => $row['jenis_kelamin'],
                'tanggal_lahir'         => $row['tanggal_lahir'],
                'nomor_telepon'         => $row['nomor_telepon'],
                'email'         => $row['email'],
                'alamat'         => $row['alamat'],
                'kota'         => $row['kota'],
                'kode_pos'         => $row['kode_pos'],
                'catatan'         => $row['catatan'],
            ]);

            // catat id dari buku yang baru dibuat
            array_push($pelanggan_id, $pelanggan->id);

        }

        // Ambil semua produk yang baru dibuat
        $pelanggans = Pelanggan::whereIn('id', $pelanggan_id)->get();
    }
}
