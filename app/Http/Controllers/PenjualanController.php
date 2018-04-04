<?php

namespace App\Http\Controllers;

use App\DetailPenjualan;
use App\KategoriProduk;
use App\Pelanggan;
use App\Penjualan;
use App\Produk;
use App\SimpanDetailPenjualan;
use App\SimpanPenjualan;
use App\TbsPenjualan;
use App\TransaksiKas;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class PenjualanController extends Controller
{
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
        //
    }

    public function pelanggan()
    {
        $pelanggan = Pelanggan::all();
        return response()->json($pelanggan);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // menampilakan produk penjualan
    public function view(Request $request)
    {
        $produks = Produk::detailProduk($request)->paginate(10);
        $array   = [];
        $num     = 0;
        foreach ($produks as $produk) {
            $array[$num]['data_produk'] = $produk;
            $num++;
        }
        //DATA PAGINATION
        $respons['current_page']   = $produks->currentPage();
        $respons['data']           = $array;
        $respons['first_page_url'] = url('/penjualan/view?page=' . $produks->firstItem());
        $respons['from']           = 1;
        $respons['last_page']      = $produks->lastPage();
        $respons['last_page_url']  = url('/penjualan/view?page=' . $produks->lastPage());
        $respons['next_page_url']  = $produks->nextPageUrl();
        $respons['path']           = url('/penjualan/view');
        $respons['per_page']       = $produks->perPage();
        $respons['prev_page_url']  = $produks->previousPageUrl();
        $respons['to']             = $produks->perPage();
        $respons['total']          = $produks->total();
        //
        return response()->json($respons);
    }
    // mencari produk penjualan
    public function search(Request $request)
    {
        $produks = Produk::where('nama_produk', 'LIKE', "%$request->search%")->paginate(9);
        $array   = [];
        $respons = [];
        $num     = 0;
        foreach ($produks as $produk) {
            // array_push($array, [
            //     'data_produk' => $produk,
            // ]);
            $array[$num]['data_produk'] = $produk;
            $num++;
        }
        $respons = $array;
        return response()->json($respons);
    }
    // menampilkan tbs_penjualan/pesanan
    public function tbsPenjualan()
    {
        $session_id   = session()->getId();
        $tbsPenjualan = DB::table('tbs_penjualans')
            ->select(
                'produks.nama_produk',
                'tbs_penjualans.harga_produk',
                'tbs_penjualans.jumlah_produk',
                'tbs_penjualans.subtotal',
                'tbs_penjualans.diskon',
                'tbs_penjualans.diskon_persen',
                'tbs_penjualans.id_tbs_penjualan',
                'tbs_penjualans.produk_id AS id_produk')
            ->join('produks', 'tbs_penjualans.produk_id', '=', 'produks.produk_id')
            ->where('tbs_penjualans.toko_id', Auth::user()->toko_id)->where('session_id', $session_id)
            ->get();

        if (count($tbsPenjualan) > 0) {

            $json_tbs = json_decode($tbsPenjualan, true);
            for ($i = 0; $i < count($json_tbs); $i++) {
                $arraySubtotal[] = $json_tbs[$i]['subtotal'];
            }
            foreach ($arraySubtotal as $key => $val) {
                $subtotalData[] = $val;
            }
            $dataArray = [
                'data'        => $tbsPenjualan,
                'total_bayar' => array_sum($subtotalData),
            ];
            // $dataArray['data']['total_bayar'] = array_sum($subtotalData);
            return response()->json($dataArray);
        } else {
            return response()->json($tbsPenjualan);
        }

    }

    // proses create table penjualan, transaksi_kas dan detail_penjualan
    public function store(Request $request)
    {
        $session_id   = session()->getId();
        $tbsPenjualan = TbsPenjualan::select()->where('session_id', $session_id)->where('toko_id', Auth::user()->toko_id);
        if ($tbsPenjualan->count() > 0) {
            $penjualan = Penjualan::create([
                'toko_id'          => Auth::user()->toko_id,
                'total_bayar'      => $request->total_bayar,
                'cara_bayar'       => $request->cara_bayar,
                'diskon'           => $request->diskon,
                'keterangan'       => $request->keterangan,
                'pelanggan_id'     => $request->pelanggan_id,
                'subtotal'         => $request->subtotal,
                'status_pemesanan' => $request->status_pemesanan,
            ]);

            $jumlah_keluar   = 0;
            $jenis_transaksi = 3;
            $toko_id         = Auth::user()->toko_id;
            TransaksiKas::create([
                'toko_id'         => $toko_id,
                'id_transaksi'    => $penjualan->id,
                'jenis_transaksi' => $jenis_transaksi,
                'jumlah_masuk'    => $penjualan->total_bayar,
                'jumlah_keluar'   => $jumlah_keluar,
            ]);
            foreach ($tbsPenjualan->get() as $tbs_penjualans) {
                // $subtotal = $tbs_penjualans->harga_produk * $tbs_penjualans->jumlah_produk;
                DetailPenjualan::create([
                    'id_produk'        => $tbs_penjualans->produk_id,
                    'id_penjualan'     => $penjualan->id,
                    'harga_produk'     => $tbs_penjualans->harga_produk,
                    'subtotal'         => $tbs_penjualans->subtotal,
                    'diskon'           => $tbs_penjualans->diskon,
                    'jumlah_produk'    => $tbs_penjualans->jumlah_produk,
                    'status_pemesanan' => $penjualan->status_pemesanan,
                ]);
            }
            $tbsPenjualan->delete();
        }
    }

    // proses create dan update tbs_penjualans
    public function prosesTbsPenjualan(Request $request)
    {
        $session_id       = session()->getId();
        $itemTbsPenjualan = TbsPenjualan::select()->where('produk_id', $request->produk_id)->where('session_id', $session_id);
        if (count($itemTbsPenjualan->get()) > 0) {
            $item     = TbsPenjualan::select()->where('produk_id', $request->produk_id)->where('session_id', $session_id)->first();
            $subtotal = ($item->jumlah_produk + 1) * $item->harga_produk;
            $diskon   = ($subtotal * $item->diskon_persen) / 100; //result diskon per produk
            $total    = $subtotal - $diskon; //potongan diskon per produk
            $itemTbsPenjualan->update([
                'jumlah_produk' => $item->jumlah_produk + $request->jumlah,
                'subtotal'      => $total,
                'diskon'        => $diskon,
            ]);
        } else {
            $session_id = session()->getId();
            TbsPenjualan::create([
                'session_id'    => $session_id,
                'produk_id'     => $request->produk_id,
                'jumlah_produk' => $request->jumlah,
                'harga_produk'  => $request->harga,
                'satuan_id'     => $request->satuan,
                'subtotal'      => $request->harga,
                'toko_id'       => Auth::user()->toko_id,
            ]);
        }

        return response(200);
    }

    // ubah kwantitas produk
    public function ubahTbsPenjualan(Request $request)
    {
        $data = DB::table('tbs_penjualans')
            ->select(
                'tbs_penjualans.harga_produk',
                'tbs_penjualans.diskon'
            )
            ->where('tbs_penjualans.toko_id', Auth::user()->toko_id)
            ->where('tbs_penjualans.id_tbs_penjualan', $request->id)->first();
        $subtotal = ($data->harga_produk * $request->jumlah) - $request->diskon; //potongan diskon per produk
        TbsPenjualan::where('id_tbs_penjualan', $request->id)->update([
            'jumlah_produk' => $request->jumlah,
            'subtotal'      => $subtotal,
            'diskon'        => $request->diskon,
            'diskon_persen' => $request->diskon_persen,
        ]);
    }

    // proses diskon per produk
    public function ubahDiskonProdukTbsPenjualan(Request $request)
    {
        $data = DB::table('tbs_penjualans')
            ->select(
                'tbs_penjualans.harga_produk',
                'tbs_penjualans.jumlah_produk'
            )
            ->where('tbs_penjualans.toko_id', Auth::user()->toko_id)
            ->where('tbs_penjualans.id_tbs_penjualan', $request->id)->first();
        // return $data;
        $subtotal = ($data->harga_produk * $data->jumlah_produk) - $request->rupiah;
        TbsPenjualan::where('id_tbs_penjualan', $request->id)->update([
            'diskon'        => $request->rupiah,
            'diskon_persen' => $request->persen,
            'subtotal'      => $subtotal,
        ]);
    }

    // create simpan_penjualan dan simpan_detail_penjualan saat klik tombol simpan
    public function simpanDataPenjualan(Request $request)
    {
        $session_id   = session()->getId();
        $tbsPenjualan = TbsPenjualan::select()->where('session_id', $session_id)->where('toko_id', Auth::user()->toko_id);
        if ($tbsPenjualan->count() > 0) {
            $penjualan = SimpanPenjualan::create([
                'toko_id'      => Auth::user()->toko_id,
                'total_bayar'  => $request->total_bayar,
                'cara_bayar'   => $request->cara_bayar,
                'diskon'       => $request->diskon,
                'pelanggan_id' => $request->pelanggan_id,
                'subtotal'     => $request->subtotal,
                'nomor_meja'   => $request->nomor_meja,
                'catatan'      => $request->catatan,
            ]);
            foreach ($tbsPenjualan->get() as $tbs_penjualans) {
                // $subtotal = $tbs_penjualans->harga_produk * $tbs_penjualans->jumlah_produk;
                SimpanDetailPenjualan::create([
                    'id_satuan'     => $tbs_penjualans->satuan_id,
                    'id_produk'     => $tbs_penjualans->produk_id,
                    'id_penjualan'  => $penjualan->id,
                    'harga_produk'  => $tbs_penjualans->harga_produk,
                    'subtotal'      => $tbs_penjualans->subtotal,
                    'diskon'        => $tbs_penjualans->diskon,
                    'diskon_persen' => $tbs_penjualans->diskon_persen,
                    'jumlah_produk' => $tbs_penjualans->jumlah_produk,
                ]);
            }
            $tbsPenjualan->delete();
        }
    }

    public function dataPagination($penjualan, $penjualanData, $link)
    {

        //DATA PAGINATION
        $respons['current_page']   = $penjualan->currentPage();
        $respons['data']           = $penjualanData;
        $respons['first_page_url'] = url('/penjualan/' . $link . '?page=' . $penjualan->firstItem());
        $respons['from']           = 1;
        $respons['last_page']      = $penjualan->lastPage();
        $respons['last_page_url']  = url('/penjualan/' . $link . '?page=' . $penjualan->lastPage());
        $respons['next_page_url']  = $penjualan->nextPageUrl();
        $respons['path']           = url('/penjualan/' . $link . '');
        $respons['per_page']       = $penjualan->perPage();
        $respons['prev_page_url']  = $penjualan->previousPageUrl();
        $respons['to']             = $penjualan->perPage();
        $respons['total']          = $penjualan->total();

        return $respons;
    }

    public function viewBukaPenjualan()
    {
        $buka_penjualan = SimpanPenjualan::dataSimpanPenjualan()->paginate(10);
        // return response()->json($buka_penjualan);
        $data = [];
        foreach ($buka_penjualan as $buka_penjualans) {
            $data_produk = SimpanDetailPenjualan::simpanDetailProduk($buka_penjualans->id)->get();
            array_push($data, ['data_simpan_penjualan' => $buka_penjualans, 'data_produk' => $data_produk]);
            // $data[]['data_simpan_penjualan'] = $buka_penjualans;
            // $data[]['data_produk']           = $data_produk;
            # code...
        }
        $link    = 'view-buka-penjualan';
        $respons = $this->dataPagination($buka_penjualan, $data, $link);
        return response()->json($respons);
    }

    // create tbs_penjualan pada saat buka penjualan
    public function createTbsPenjualan(Request $request)
    {
        $data_simpan_penjualan        = SimpanPenjualan::select()->where('id', $request->id)->where('toko_id', Auth::user()->toko_id)->first();
        $data_detail_simpan_penjualan = SimpanDetailPenjualan::dataSimpanDetailPenjualan($data_simpan_penjualan->id)->get();
        $tbs_penjualan                = TbsPenjualan::select()->where('toko_id', Auth::user()->toko_id)->get();
        if (count($tbs_penjualan) < 1) {
            foreach ($data_detail_simpan_penjualan as $data_detail_simpan_penjualans) {
                $session = session()->getId();
                TbsPenjualan::create([
                    'session_id'    => $session,
                    'satuan_id'     => $data_detail_simpan_penjualans->id_satuan,
                    'produk_id'     => $data_detail_simpan_penjualans->id_produk,
                    'harga_produk'  => $data_detail_simpan_penjualans->harga_produk,
                    'jumlah_produk' => $data_detail_simpan_penjualans->jumlah_produk,
                    'diskon'        => $data_detail_simpan_penjualans->diskon,
                    'diskon_persen' => $data_detail_simpan_penjualans->diskon_persen,
                    'subtotal'      => $data_detail_simpan_penjualans->subtotal,
                    'toko_id'       => Auth::user()->toko_id,
                ]);
            }
            $array = array();
            array_push($array, ['total_bayar' => $data_simpan_penjualan->total_bayar, 'diskon' =>
                $data_simpan_penjualan->diskon, 'nomor_meja' => $data_simpan_penjualan->nomor_meja, 'catatan' => $data_simpan_penjualan->catatan]);
            return response()->json($data_detail_simpan_penjualan);
            # code...
        }
    }

    public function hapusTbsPenjualan($id)
    {
        if (TbsPenjualan::destroy($id)) {
            return response('200');
        } else {
            return;
        }

    }

    // menampilkan kategori produk
    public function kategoriProduk()
    {
        return KategoriProduk::where('toko_id', Auth::user()->toko_id)->get();
    }

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function edit($id)
    {
        //
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
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function kategori_produk()
    // {
    //     return KategoriProduk::paginate(10);
    // }

    public function produk()
    {
        return Produk::paginate(10);
    }

    public function show($id)
    {
        //
    }

}
