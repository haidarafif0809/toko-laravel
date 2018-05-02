<?php

namespace App\Http\Controllers;

use App\DetailPenjualan;
use App\KategoriProduk;
use App\Modifier;
use App\Produk;
use Auth;
use Carbon\Carbon;
use DB;
use Excel;
use File;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;

class ProdukController extends Controller
{

    public function index()
    {

    }

    public function tes()
    {
        return Auth::user()->id;
    }

    public function view()
    {
        $produk = Produk::select(['kategori_produks.nama_kategori_produk as nama_kategori_produk', 'produks.produk_id as produk_id', 'produks.nama_produk as nama_produk', 'produks.harga_jual'])
            ->leftJoin('kategori_produks', 'produks.kategori_produks_id', '=', 'kategori_produks.id')
            ->where('produks.toko_id', Auth::user()->toko_id)
            ->orderBy('produk_id', 'desc')
            ->paginate(10);

        $array = array();
        foreach ($produk as $produks) {
            array_push($array, [
                'nama_produk'     => $produks->nama_produk,
                'harga_jual'      => $produks->harga_jual,
                'kategori_produk' => $produks->nama_kategori_produk,
                'produk_id'       => $produks->produk_id,

            ]);
        }
        //DATA PAGINATION
        $respons['current_page']   = $produk->currentPage();
        $respons['data']           = $array;
        $respons['first_page_url'] = url('produk/view?page=' . $produk->firstItem());
        $respons['from']           = 1;
        $respons['last_page']      = $produk->lastPage();
        $respons['last_page_url']  = url('produk/view?page=' . $produk->lastPage());
        $respons['next_page_url']  = $produk->nextPageUrl();
        $respons['path']           = url('produk/view');
        $respons['per_page']       = $produk->perPage();
        $respons['prev_page_url']  = $produk->previousPageUrl();
        $respons['to']             = $produk->perPage();
        $respons['total']          = $produk->total();
        //DATA PAGINATION

        return response()->json($respons);
    }

    public function cari(Request $request)
    {

        $produk = Produk::select(['kategori_produks.nama_kategori_produk as nama_kategori_produk', 'produks.produk_id as produk_id', 'produks.nama_produk as nama_produk', 'produks.harga_jual'])
            ->leftJoin('kategori_produks', 'produks.kategori_produks_id', '=', 'kategori_produks.id')
            ->where(function ($query) use ($request) {
                $query->orwhere('nama_produk', 'LIKE', "%$request->pencarian%")
                    ->orWhere('nama_kategori_produk', 'LIKE', "%$request->pencarian%");
            })
            ->where('produks.toko_id', Auth::user()->toko_id)
            ->orderBy('produk_id', 'desc')
            ->paginate(10);

        $array = array();
        foreach ($produk as $produks) {
            array_push($array, [
                'nama_produk'     => $produks->nama_produk,
                'harga_jual'      => $produks->harga_jual,
                'kategori_produk' => $produks->nama_kategori_produk,
                'produk_id'       => $produks->produk_id,

            ]);
        }
        //DATA PAGINATION
        $respons['current_page']   = $produk->currentPage();
        $respons['data']           = $array;
        $respons['first_page_url'] = url('produk/view?page=' . $produk->firstItem() . '&pencarian=' . $request->pencarian);
        $respons['from']           = 1;
        $respons['last_page']      = $produk->lastPage();
        $respons['last_page_url']  = url('produk/view?page=' . $produk->lastPage() . '&pencarian=' . $request->pencarian);
        $respons['next_page_url']  = $produk->nextPageUrl();
        $respons['path']           = url('produk/view');
        $respons['per_page']       = $produk->perPage();
        $respons['prev_page_url']  = $produk->previousPageUrl();
        $respons['to']             = $produk->perPage();
        $respons['total']          = $produk->total();
        //DATA PAGINATION

        return response()->json($respons);
    }

    public function detail($id)
    {
        $produk = Produk::where('produk_id', $id)->first();
        return response()->json($produk);
    }

    public function produkModifiersId()
    {
        $produk_modifier = Modifier::all();
        return response()->json($produk_modifier);
    }

    public function produkModifiersIdEdit($id_produk)
    {
        $produk_modifier = Produk::select('produk_modifier_id')->where('produk_id', $id_produk)->first();
        $produk_modifier = explode(',', $produk_modifier->produk_modifier_id);
        return response()->json($produk_modifier);
    }

    public function kategoriProduksId()
    {
        $kategoriProduk = KategoriProduk::all()->where('toko_id', Auth::user()->toko_id);
        return response()->json($kategoriProduk);
    }

    public function detailModifier()
    {
        $modifier       = Modifier::select(['id', 'nama_modifier'])->get();
        $array_modifier = [];
        foreach ($modifier as $key => $val) {
            $array_modifier[$val['id']] = $val['nama_modifier'];

        }
        return $array_modifier;
    }

    public function statusJual()
    {
        $status_jual = Produk::select('bisa_dijual')->first();
        return response()->json($status_jual);
    }

    public function detailKategoriProdukDariProduk($id)
    {
        $produk         = Produk::where('produk_id', $id)->first();
        $kategoriProduk = KategoriProduk::where('id', $produk->kategori_produks_id)->first();

        return response()->json($kategoriProduk);
    }

    public function create()
    {
//
    }

    public function store(Request $request)
    {
        //validate

        if ($request->foto !== null) {
            $this->validate($request, [
                'foto' => 'image64:jpeg,jpg,png|max:6072000',
            ]);

            $imageData    = $request->foto;
            $ekstensi     = explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            $fileName     = Carbon::now()->timestamp . '.' . $ekstensi;
            $image_resize = Image::make($request->foto);
            $image_resize->fit(200);
            $image_resize->save(public_path('foto_produk/' . $fileName));
            // Image::make($request->foto)->save(public_path('foto_produk/') . $fileName);
            // // Mengambil file yang diupload
            // $uploaded_foto = $request->foto;
            // // mengambil extension file
            // $extension = $uploaded_foto->getClientOriginalExtension();
            // // membuat nama file random berikut extension
            // $filename     = str_random(40) . '.' . $extension;
            // $image_resize = Image::make($foto->getRealPath());
            // $image_resize->fit(300);
            // $image_resize->save(public_path('foto_produk/' . $filename));
        } else {
            $this->validate($request, [
                'nama_produk'         => 'required',
                'kategori_produks_id' => 'required|exists:kategori_produks,id',
                'harga_jual'          => 'required|numeric',
                'bisa_dijual'         => 'required',
                'satuan'              => 'required',
                'produk_modifier_id'  => 'nullable|exists:modifiers,id',
            ]);

        }

        $modifier        = '';
        $noUrut          = 1;
        $produk_modifier = $request->produk_modifier_id;
        if (is_array($produk_modifier) || is_object($produk_modifier)) {
            foreach ($produk_modifier as $id_modifier) {
                if ($noUrut != count($request->produk_modifier_id)) {
                    $modifier .= $id_modifier . ',';
                } else {
                    $modifier .= $id_modifier;
                }
                $noUrut++;
            }
        }

        // insert
        $toko_id = Auth::user()->toko_id;
        $produk  = Produk::create([
            'toko_id'             => $toko_id,
            'nama_produk'         => $request->nama_produk,
            'kategori_produks_id' => $request->kategori_produks_id,
            'harga_jual'          => $request->harga_jual,
            'bisa_dijual'         => $request->bisa_dijual,
            'foto'                => (!empty($fileName) ? $fileName : ''),
            'satuan'              => $request->satuan,
            'produk_modifier_id'  => $modifier,
        ]);
    }

    public function show($id)
    {
//
    }

    public function edit($id)
    {
        $produk = Produk::where('produk_id', $id)->first();
        return $produk;
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);

        $this->validate($request, [
            'nama_produk'         => 'required',
            'kategori_produks_id' => 'required|exists:kategori_produks,id',
            'harga_jual'          => 'required|numeric',
            'bisa_dijual'         => 'required',
            'satuan'              => 'required',
            'produk_modifier_id'  => 'nullable',
        ]);

        $modifier        = '';
        $noUrut          = 1;
        $produk_modifier = $request->produk_modifier_id;
        if (is_array($produk_modifier) || is_object($produk_modifier)) {
            foreach ($produk_modifier as $id_modifier) {
                if ($noUrut != count($request->produk_modifier_id)) {
                    $modifier .= $id_modifier . ',';
                } else {
                    $modifier .= $id_modifier;
                }
                $noUrut++;
            }
        }

        $arrUpdateProduk = [
            'nama_produk'         => $request->nama_produk,
            'kategori_produks_id' => $request->kategori_produks_id,
            'harga_jual'          => $request->harga_jual,
            'bisa_dijual'         => $request->bisa_dijual,
            'satuan'              => $request->satuan,
            'produk_modifier_id'  => $modifier,
        ];

        if ($request->foto !== null) {
            $this->validate($request, [
                'foto' => 'image64:jpeg,jpg,png|max:3072000',
            ]);
            $imageData = $request->foto;
            $ekstensi  = explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];

            $fileName = Carbon::now()->timestamp . '.' . $ekstensi;
            // Image::make($request->foto)->save(public_path('foto_produk/') . $fileName);
            $image_resize = Image::make($request->foto);
            $image_resize->fit(200);
            $image_resize->save(public_path('foto_produk/' . $fileName));
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

    public function destroy($id)
    {
        $detailPenjualan = DetailPenjualan::select('id_produk')->get();

        foreach ($detailPenjualan as $id_produk) {
            if ($id_produk->id_produk == $id) {
                return response()->json(['error' => 1]);
            }

        }

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
                    'Nama Produk',
                    'Kategori Produk',
                    'Harga Jual',
                    'Satuan',
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
            'Nama Produk'     => 'required',
            'Kategori Produk' => 'required|exists:kategori_produks,id',
            'Harga Jual'      => 'required|numeric',
            'Satuan'          => 'required',
            'Bisa Dijual'     => 'required',

        ];
        // Catat semua id buku baru
        // ID ini kita butuhkan untuk menghitung total buku yang berhasil diimport
        $produk_id  = [];
        $errors     = [];
        $lineErrors = [];
        $no         = 1;

        // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuang spasi dan mengubah huruf menjadi lowercase (huruf kecil)
            $bisaDijual = trim(strtolower($row['bisa_dijual']));
            if (!empty($row['bisa_dijual'])) {
                if ($bisaDijual !== 'ya' && $bisaDijual !== 'tidak') {
                    $errors['bisaDijual'][] = [
                        'line'    => $no,
                        'message' => 'Nilai dari kolom Bisa Dijual hanya boleh berisi ya atau tidak.',
                    ];
                    $lineErrors[] = $no;
                }
            } else {
                $errors['bisaDijual'][] = [
                    'line'    => $no,
                    'message' => 'Nilai dari kolom Bisa Dijual tidak boleh kosong.',
                ];
                $lineErrors[] = $no;
            }
            $no++;
        }
        // return response()->json($errors);

        $jumlahProduk                 = ['jumlahProduk' => ''];
        $jumlahProduk['jumlahProduk'] = ($no - 1);

        // Perulangan kedua untuk penambahan data jika tidak ada error.
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
                foreach ($errors['bisaDijual'] as $key => $val) {
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

            // Variable array kosong untuk menampung pesan error
            $errorMsg = [];
            // Membuang spasi dan mengubah huruf menjadi lowercase (huruf kecil)
            $bisaDijual = trim(strtolower($row['bisa_dijual']));
            if ($bisaDijual !== 'ya' && $bisaDijual !== 'tidak') {
                $errorMsg['pesan'] = 'Nilai dari kolom Bisa Dijual hanya boleh berisi ya atau tidak';
                return response()->json($errorMsg);
            }

            $satuanProduk = trim(strtolower($row['satuan']));
            if ($satuanProduk == 'pcs') {
                $satuan = 1;
            } elseif ($satuanProduk == 'porsi') {
                $satuan = 2;
            } elseif ($satuanProduk == 'pack') {
                $satuan = 3;
            } else {
                $satuan = $row['satuan'];
            }

            // membuat satuan
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

            $bisa_dijual = ($row['bisa_dijual'] == 'ya' ? 1 : 0);
            if (in_array($importNamaKategoriProduk, $arrayNamaKategoriProduk)) {

                // buat produk baru
                $toko_id = Auth::user()->toko_id;
                $produk  = Produk::create([
                    'toko_id'             => $toko_id,
                    'nama_produk'         => $row['nama_produk'],
                    'kategori_produks_id' => $arrNamaIdKategoriProduk[$importNamaKategoriProduk],
                    'harga_jual'          => $row['harga_jual'],
                    'satuan'              => $satuan,
                    'bisa_dijual'         => $bisa_dijual,
                    'produk_modifier_id'  => '',

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
                $toko_id = Auth::user()->toko_id;
                $produk  = Produk::create([
                    'toko_id'             => $toko_id,
                    'nama_produk'         => $row['nama_produk'],
                    'kategori_produks_id' => $idKategoriProdukTerbaru->id,
                    'harga_jual'          => $row['harga_jual'],
                    'satuan'              => $satuan,
                    'bisa_dijual'         => $bisa_dijual,
                    'produk_modifier_id'  => '',

                ]);
            }

            // catat id dari buku yang baru dibuat
            // array_push($produk_id, $produk->produk_id);

        }
        return response()->json($jumlahProduk);
        // Ambil semua produk yang baru dibuat
        $produks = Produk::whereIn('produk_id', $produk_id)->get();
    }
}
