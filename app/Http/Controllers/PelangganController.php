<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\User;
use Auth;
use Excel;
use File;
use Illuminate\Http\Request;
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

        $pelanggan     = Pelanggan::where('toko_id', Auth::user()->toko_id)->orderBy('id', 'desc')->paginate(1000000);
        $pelangganData = [];

        foreach ($pelanggan as $key => $val) {
            $kode_pelanggan                        = explode('/', $val->kode_pelanggan);
            $kode_pelanggan                        = $kode_pelanggan[1] . '/' . $kode_pelanggan[2];
            $pelangganData[]                       = $val;
            $pelangganData[$key]['kode_pelanggan'] = $kode_pelanggan;
        }

        //DATA PAGINATION
        $respons['current_page']   = $pelanggan->currentPage();
        $respons['data']           = $pelangganData;
        $respons['first_page_url'] = url('/profile-toko/view?page=' . $pelanggan->firstItem());
        $respons['from']           = 1;
        $respons['last_page']      = $pelanggan->lastPage();
        $respons['last_page_url']  = url('/profile-toko/view?page=' . $pelanggan->lastPage());
        $respons['next_page_url']  = $pelanggan->nextPageUrl();
        $respons['path']           = url('/profile-toko/view');
        $respons['per_page']       = $pelanggan->perPage();
        $respons['prev_page_url']  = $pelanggan->previousPageUrl();
        $respons['to']             = $pelanggan->perPage();
        $respons['total']          = $pelanggan->total();

        return response()->json($respons);
    }
    public function search(Request $request)
    {
        $cari_pelanggan = Pelanggan::where('toko_id', Auth::user()->toko_id)
            ->where(function ($query) use ($request) {
                $query->orwhere('kode_pelanggan', 'LIKE', "%$request->search%")
                    ->orWhere('nama_pelanggan', 'LIKE', "%$request->search%")
                    ->orWhere('nomor_telepon', 'LIKE', "%$request->search%")
                    ->orWhere('email', 'LIKE', "%$request->search%");
            })->orderBy('id', 'desc')->paginate(1000000);

        $pelangganData = [];

        foreach ($cari_pelanggan as $key => $val) {
            $kode_pelanggan                        = explode('/', $val->kode_pelanggan);
            $kode_pelanggan                        = $kode_pelanggan[1] . '/' . $kode_pelanggan[2];
            $pelangganData[]                       = $val;
            $pelangganData[$key]['kode_pelanggan'] = $kode_pelanggan;
        }

        //DATA PAGINATION
        $respons['current_page']   = $cari_pelanggan->currentPage();
        $respons['data']           = $pelangganData;
        $respons['first_page_url'] = url('/profile-toko/view?page=' . $cari_pelanggan->firstItem());
        $respons['from']           = 1;
        $respons['last_page']      = $cari_pelanggan->lastPage();
        $respons['last_page_url']  = url('/profile-toko/view?page=' . $cari_pelanggan->lastPage());
        $respons['next_page_url']  = $cari_pelanggan->nextPageUrl();
        $respons['path']           = url('/profile-toko/view');
        $respons['per_page']       = $cari_pelanggan->perPage();
        $respons['prev_page_url']  = $cari_pelanggan->previousPageUrl();
        $respons['to']             = $cari_pelanggan->perPage();
        $respons['total']          = $cari_pelanggan->total();

        return response()->json($respons);
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
            'nama_pelanggan' => '',
            'jenis_kelamin'  => 'required',
            'nomor_telepon'  => 'max:13|unique:pelanggans,nomor_telepon,NULL,id,toko_id,' . Auth::user()->toko_id,
            'kode_pos'       => 'max:5',
            'email'          => '',

        ]);
        $id_toko        = Auth::User()->toko_id;
        $kode_pelanggan = Pelanggan::kode_pelanggan($id_toko);
        $pelanggan      = Pelanggan::create([
            'toko_id'        => Auth::User()->toko_id,
            'kode_pelanggan' => $kode_pelanggan,
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
            'nama_pelanggan' => 'required',
            'jenis_kelamin'  => 'required',
            'nomor_telepon'  => 'max:13|unique:pelanggans,nomor_telepon,' . $request->id . ',id,toko_id,' . Auth::user()->toko_id,
            'email'          => '',
            'kode_pos'       => 'max:5',
        ]);
        $pelanggan = Pelanggan::find($id)->update([
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
                    'Catatan',
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
            'Nama Pelanggan' => 'required',
            'Jenis Kelamin'  => 'required',
            'Tanggal Lahir'  => '',
            'Nomor Telepon'  => 'required|max:13|unique:pelanggans,nomor_telepon',
            'Email'          => '',
            'Alamat'         => '',
            'Kota'           => '',
            'Kode Pos'       => 'max:5',
            'Catatan'        => '',
        ];
        // Catat semua id pelanggan baru
        // ID ini kita butuhkan untuk menghitung total pelanggan yang berhasil diimport
        $pelanggan_id = [];
        $errors       = [];
        $lineErrors   = [];
        $no           = 1;

        // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuang spasi dan mengubah huruf menjadi lowercase (huruf kecil)
            $jenisKelamin = trim(strtolower($row['jenis_kelamin']));
            if (!empty($row['jenis_kelamin'])) {
                if ($jenisKelamin !== 'laki-laki' && $jenisKelamin !== 'perempuan') {
                    $errors['jenisKelamin'][] = [
                        'line'    => $no,
                        'message' => 'Nilai dari kolom Jenis Kelamin hanya boleh berisi laki-laki atau perempuan.',
                    ];
                    $lineErrors[] = $no;
                }
            } else {
                $errors['jenisKelamin'][] = [
                    'line'    => $no,
                    'message' => 'Nilai dari kolom Jenis Kelamin tidak boleh kosong.',
                ];
                $lineErrors[] = $no;
            }
            $no++;
        }
        // return response()->json($errors);
        $jumlahPelanggan                    = ['jumlahPelanggan' => ''];
        $jumlahPelanggan['jumlahPelanggan'] = ($no - 1);

        foreach ($excels as $row) {
            // Untuk menampilkan error dan menghentikan jalannya script
            // sehingga jika ada error tidak ada data yang akan dimasukkan
            // kedalam database
            if (count($errors) > 0) {

                // Membuat variable array dengan index errorMsg.
                // Tujuan membuat index ini adalah agar memperjelas struktur kode
                // saat kita akan mengambilnya dari kode vue
                $pesan = ['errorMsg' => ''];

                // Menyusun dan memasukkan pesan error (baris dan pesannya) kedalam variable
                // array yang telah kita buat diatas pada index errorMsg
                foreach ($errors['jenisKelamin'] as $key => $val) {
                    if ($val['line'] == end($lineErrors)) {
                        $pesan['errorMsg'] .= 'Baris ke ' . $val['line'] . ' ' . $val['message'];
                    } else {
                        $pesan['errorMsg'] .= 'Baris ke ' . $val['line'] . ' ' . $val['message'] . '<br>';
                    }
                }
                return response()->json($pesan);
            }

            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
            $validator = Validator::make($row->toArray(), $rowRules);

            // return response()->json($a);

            // Variable array kosong untuk menampung pesan error
            $errorMsg = [];
            // Membuang spasi dan mengubah huruf menjadi lowercase (huruf kecil)
            $jenisKelamin = trim(strtolower($row['jenis_kelamin']));
            if ($jenisKelamin !== 'laki-laki' && $jenisKelamin !== 'perempuan') {
                $errorMsg['pesan'] = 'kolom Jenis Kelamin hanya boleh berisi laki-laki atau perempuan';
                return response()->json($errorMsg);
            }
            if ($jenisKelamin == 'laki-laki') {
                $gender = 1;
            } elseif ($jenisKelamin == 'perempuan') {
                $gender = 2;
            }

            /*
            |---------------------------------------------------------------------------
            | Mengecek nama kategori pelanggan
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

            // buat produk baru

            $id_toko        = Auth::User()->toko_id;
            $kode_pelanggan = Pelanggan::kode_pelanggan($id_toko);
            $pelanggan      = Pelanggan::create([
                'toko_id'        => Auth::User()->toko_id,
                'kode_pelanggan' => $kode_pelanggan,
                'nama_pelanggan' => $row['nama_pelanggan'],
                'jenis_kelamin'  => $gender,
                'tanggal_lahir'  => $row['tanggal_lahir'],
                'nomor_telepon'  => $row['nomor_telepon'],
                'email'          => $row['email'],
                'alamat'         => $row['alamat'],
                'kota'           => $row['kota'],
                'kode_pos'       => $row['kode_pos'],
                'catatan'        => $row['catatan'],
            ]);

            // catat id dari pelanggan yang baru dibuat
            array_push($pelanggan_id, $pelanggan->id);

        }
        return response()->json($jumlahPelanggan);
        // Ambil semua produk yang baru dibuat
        $pelanggans = Pelanggan::whereIn('id', $pelanggan_id)->get();

        //redirect ke form jika tidak ada team yang berhasil di import
        // if($pelanggans->count() == 0){
        //     Session::flash('flash_notification',[
        //       'level' =>'danger',
        //       'message'=>'Tidak ada Pelanggan yang diimport'

        //   ]);
        //     return redirect()->back();
        // }

    }

    public function exportExcel()
    {
        $data = Pelanggan::select('kode_pelanggan', 'nama_pelanggan', 'tanggal_lahir', 'nomor_telepon', 'alamat', 'jenis_kelamin', 'email', 'kota', 'kode_pos', 'catatan')->get();
        Excel::create('Semua Data Pelanggan', function ($excel) use ($data) {
            $excel->sheet('Data Pelanggan', function ($sheet) use ($data) {
                // $sheet->fromArray($data);
                $row = 1;
                $sheet->row($row, [
                    'Member Id',
                    'Nama Pelanggan',
                    'Jenis Kelamin',
                    'Tanggal Lahir',
                    'Nomor Telepon',
                    'Email',
                    'Alamat',
                    'Kota',
                    'Kode Pos',
                    'Catatan',
                ]);
                foreach ($data as $app) {
                    $sheet->row(++$row, [
                        $app->kode_pelanggan,
                        $app->nama_pelanggan,
                        $app->jenis_kelamin,
                        $app->tanggal_lahir,
                        $app->nomor_telepon,
                        $app->email,
                        $app->alamat,
                        $app->kota,
                        $app->kode_pos,
                        $app->catatan,
                    ]);
                }
            });

        })->download('xlsx');
    }
}
