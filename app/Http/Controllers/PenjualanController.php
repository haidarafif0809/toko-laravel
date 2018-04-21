<?php

namespace App\Http\Controllers;

use App\DetailPenjualan;
use App\KategoriProduk;
use App\Modifier;
use App\Pelanggan;
use App\Penjualan;
use App\Produk;
use App\SimpanDetailPenjualan;
use App\SimpanPenjualan;
use App\TbsPenjualan;
use App\Toko;
use App\TransaksiKas;
use Auth;
use Carbon\Carbon;
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
    public function dataModifier($id)
    {
        $produk = Produk::select([
            'modifiers.nama_modifier',
            'produks.produk_modifier_id',
        ])
            ->leftJoin('modifiers', 'modifiers.id', '=', 'produks.produk_modifier_id')
            ->where('produk_id', $id)
            ->first();
        $array = [];
        $data  = explode(',', $produk->produk_modifier_id);
        // $array['data'] = $data;
        foreach ($data as $datas) {
            $modifier            = Modifier::select('id', 'nama_modifier', 'harga_modifier')->whereId($datas)->first();
            $array['modifier'][] = $modifier;
            # code...
        }
        return response()->json($array);
    }

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
                'tbs_penjualans.id_simpan_penjualan',
                'tbs_penjualans.id_modifier',
                'tbs_penjualans.jumlah_produk',
                'tbs_penjualans.subtotal',
                'tbs_penjualans.diskon',
                'tbs_penjualans.diskon_persen',
                'tbs_penjualans.id_tbs_penjualan',
                'tbs_penjualans.produk_id AS id_produk')
            ->join('produks', 'tbs_penjualans.produk_id', '=', 'produks.produk_id')
            ->where('tbs_penjualans.toko_id', Auth::user()->toko_id)->where('session_id', $session_id)
        ;

        if (count($tbsPenjualan->get()) > 0) {

            $json_tbs = json_decode($tbsPenjualan->get(), true);
            for ($i = 0; $i < count($json_tbs); $i++) {
                $arraySubtotal[] = $json_tbs[$i]['subtotal'];
                $arraySubtotal2  = $json_tbs[$i]['id_simpan_penjualan'];
            }
            foreach ($arraySubtotal as $key => $val) {
                $subtotalData[] = $val;
            }
            // nama modifier per produk
            $array = [];
            foreach ($tbsPenjualan->get() as $tbs_penjualans) {
                $data           = explode(',', $tbs_penjualans->id_modifier);
                $array_modifier = [];
                foreach ($data as $datas) {
                    $modifier         = Modifier::select('nama_modifier')->whereId($datas)->first();
                    $array_modifier[] = $modifier;
                    # code...
                }
                array_push($array, [
                    'nama_produk'         => $tbs_penjualans->nama_produk,
                    'harga_produk'        => $tbs_penjualans->harga_produk,
                    'id_simpan_penjualan' => $tbs_penjualans->id_simpan_penjualan,
                    'id_modifier'         => $tbs_penjualans->id_modifier,
                    'jumlah_produk'       => $tbs_penjualans->jumlah_produk,
                    'subtotal'            => $tbs_penjualans->subtotal,
                    'diskon'              => $tbs_penjualans->diskon,
                    'diskon_persen'       => $tbs_penjualans->diskon_persen,
                    'id_tbs_penjualan'    => $tbs_penjualans->id_tbs_penjualan,
                    'id_produk'           => $tbs_penjualans->id_produk,
                    'modifier'            => $array_modifier,
                ]);
                # code...

            }
            // return $array;

            $dataArray = [
                'data'                => $array,
                'total_bayar'         => array_sum($subtotalData),
                'id_simpan_penjualan' => $arraySubtotal2,
            ];
            // $dataArray['data']['total_bayar'] = array_sum($subtotalData);
            return response()->json($dataArray);
        } else {
            return response()->json($tbsPenjualan->get());
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
                'tunai'            => $request->bayar,
                'kembalian'        => $request->kembalian,
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
                    'id_modifier'      => $tbs_penjualans->id_modifier,
                    'harga_produk'     => $tbs_penjualans->harga_produk,
                    'subtotal'         => $tbs_penjualans->subtotal,
                    'diskon'           => $tbs_penjualans->diskon,
                    'jumlah_produk'    => $tbs_penjualans->jumlah_produk,
                    'status_pemesanan' => $penjualan->status_pemesanan,
                ]);
            }
            $tbsPenjualan->delete();
            $respon['id_penjualan'] = $penjualan->id;
            return response()->json($respon);
        }
    }

    // proses create dan update tbs_penjualans
    public function prosesTbsPenjualan(Request $request)
    {
        $session_id      = session()->getId();
        $modifier        = '';
        $noUrut          = 1;
        $produk_modifier = $request->id_modifier;
        $harga_modifier  = 0;
        if (is_array($produk_modifier) || is_object($produk_modifier)) {
            foreach ($produk_modifier as $produk_modifiers) {
                if ($noUrut != count($request->id_modifier)) {
                    $modifier .= $produk_modifiers . ',';
                } elseif ($noUrut == count($request->id_modifier)) {
                    $modifier .= $produk_modifiers;
                }
                $noUrut++;
                $harga = Modifier::select([DB::raw('SUM(harga_modifier) as harga')])->whereId($produk_modifiers)->first()->harga;
                $harga_modifier += $harga;
            }
        }
        $itemTbsPenjualan  = TbsPenjualan::select()->where('produk_id', $request->produk_id)->where('id_modifier', $modifier)->where('session_id', $session_id);
        $sitemTbsPenjualan = TbsPenjualan::select()->where('produk_id', $request->produk_id)->where('id_modifier', null)->where('session_id', $session_id);
        // return yang punya modifier
        if (count($itemTbsPenjualan->get()) < 1 && $produk_modifier != null) {
            $session_id = session()->getId();

            TbsPenjualan::create([
                'session_id'    => $session_id,
                'produk_id'     => $request->produk_id,
                'jumlah_produk' => $request->jumlah,
                'harga_produk'  => $request->harga + $harga_modifier,
                'satuan_id'     => $request->satuan,
                'subtotal'      => $request->harga + $harga_modifier,
                'id_modifier'   => $modifier,
                'toko_id'       => Auth::user()->toko_id,
            ]);
        } elseif (count($itemTbsPenjualan->get()) > 0 && $produk_modifier != null) {
            $subtotal = ($itemTbsPenjualan->first()->jumlah_produk + 1) * $itemTbsPenjualan->first()->harga_produk;
            $diskon   = ($subtotal * $itemTbsPenjualan->first()->diskon_persen) / 100; //result diskon per produk
            $total    = $subtotal - $diskon; //potongan diskon per produk
            $itemTbsPenjualan->update([
                'jumlah_produk' => $itemTbsPenjualan->first()->jumlah_produk + $request->jumlah,
                'subtotal'      => $total,
                'diskon'        => $diskon,
                'id_modifier'   => $modifier,
            ]);
        }
        // return yang punya modifier
        if (count($sitemTbsPenjualan->get()) < 1 && $produk_modifier == null) {
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
            # code...
        } elseif (count($sitemTbsPenjualan->get()) > 0 && $produk_modifier == null) {
            $subtotal = ($sitemTbsPenjualan->first()->jumlah_produk + 1) * $sitemTbsPenjualan->first()->harga_produk;
            $diskon   = ($subtotal * $sitemTbsPenjualan->first()->diskon_persen) / 100; //result diskon per produk
            $total    = $subtotal - $diskon; //potongan diskon per produk
            $sitemTbsPenjualan->update([
                'jumlah_produk' => $sitemTbsPenjualan->first()->jumlah_produk + $request->jumlah,
                'subtotal'      => $total,
                'diskon'        => $diskon,
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
        if ($tbsPenjualan->count() > 0 && $request->id_simpan_penjualan != null) {
            $data = SimpanDetailPenjualan::where('id_penjualan', $request->id_simpan_penjualan);
            $data->delete();
            $penjualan = SimpanPenjualan::where('id', $request->id_simpan_penjualan)->update([
                // 'toko_id'      => Auth::user()->toko_id,
                'total_bayar'  => $request->total_bayar,
                'cara_bayar'   => $request->cara_bayar,
                'diskon'       => $request->diskon,
                'pelanggan_id' => $request->pelanggan_id,
                'subtotal'     => $request->subtotal,
                'nomor_meja'   => $request->nomor_meja,
                'catatan'      => $request->catatan,
            ]);
            foreach ($tbsPenjualan->get() as $tbs_penjualans) {
                SimpanDetailPenjualan::create([
                    'id_satuan'     => $tbs_penjualans->satuan_id,
                    'id_produk'     => $tbs_penjualans->produk_id,
                    'id_penjualan'  => $tbs_penjualans->id_simpan_penjualan,
                    'harga_produk'  => $tbs_penjualans->harga_produk,
                    'subtotal'      => $tbs_penjualans->subtotal,
                    'diskon'        => $tbs_penjualans->diskon,
                    'diskon_persen' => $tbs_penjualans->diskon_persen,
                    'id_modifier'   => $tbs_penjualans->id_modifier,
                    'jumlah_produk' => $tbs_penjualans->jumlah_produk,
                ]);
            }
            $tbsPenjualan->delete();
            $respon['id_penjualan'] = $request->id_simpan_penjualan;
            return response()->json($respon);
        } elseif ($tbsPenjualan->count() > 0 && $request->id_simpan_penjualan === null) {
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
                $SimpanDetailPenjualan = SimpanDetailPenjualan::create([
                    'id_satuan'     => $tbs_penjualans->satuan_id,
                    'id_produk'     => $tbs_penjualans->produk_id,
                    'id_penjualan'  => $penjualan->id,
                    'harga_produk'  => $tbs_penjualans->harga_produk,
                    'subtotal'      => $tbs_penjualans->subtotal,
                    'diskon'        => $tbs_penjualans->diskon,
                    'diskon_persen' => $tbs_penjualans->diskon_persen,
                    'id_modifier'   => $tbs_penjualans->id_modifier,
                    'jumlah_produk' => $tbs_penjualans->jumlah_produk,
                ]);
            }
            $tbsPenjualan->delete();
            $respon['id_penjualan'] = $penjualan->id;
            return response()->json($respon);
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

    public function viewBukaPenjualan(Request $request)
    {
        $buka_penjualan = SimpanPenjualan::dataSimpanPenjualan($request)->paginate(10);
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

    // create tbs_penjualan pada saat klik buka di simpan penjualan
    public function createTbsPenjualan(Request $request)
    {
        $data_tbs                     = 0;
        $session_id                   = session()->getId();
        $data_simpan_penjualan        = SimpanPenjualan::select()->where('id', $request->id)->where('toko_id', Auth::user()->toko_id);
        $data_detail_simpan_penjualan = SimpanDetailPenjualan::dataSimpanDetailPenjualan($data_simpan_penjualan->first()->id);
        $tbs_penjualan                = TbsPenjualan::select()->where('session_id', $session_id)->where('toko_id', Auth::user()->toko_id)->get();
        foreach ($data_detail_simpan_penjualan->get() as $data_detail_simpan_penjualans) {
            $session = session()->getId();
            TbsPenjualan::create([
                'session_id'          => $session,
                'id_simpan_penjualan' => $request->id,
                'satuan_id'           => $data_detail_simpan_penjualans->id_satuan,
                'produk_id'           => $data_detail_simpan_penjualans->id_produk,
                'harga_produk'        => $data_detail_simpan_penjualans->harga_produk,
                'jumlah_produk'       => $data_detail_simpan_penjualans->jumlah_produk,
                'diskon'              => $data_detail_simpan_penjualans->diskon,
                'diskon_persen'       => $data_detail_simpan_penjualans->diskon_persen,
                'id_modifier'         => $data_detail_simpan_penjualans->id_modifier,
                'subtotal'            => $data_detail_simpan_penjualans->subtotal,
                'toko_id'             => Auth::user()->toko_id,
            ]);

            $data_tbs++;
        }
        $respon['data_tbs']      = $data_tbs;
        $respon['diskon_faktur'] = $data_simpan_penjualan->first()->diskon;

        return response()->json($respon);
    }

    // mendapatkan diskon perfaktur saat klik buka di buka penjualan
    public function diskonSimpanPenjualan(Request $request)
    {
        $data_simpan_penjualan = SimpanPenjualan::select()->where('id', $request->id)->where('toko_id', Auth::user()->toko_id)->first();
        return response()->json($data_simpan_penjualan);
    }
    public function cetakPenjualan(Request $request)
    {
        $toko = Toko::select(
            'tokos.nama_toko',
            'tokos.no_telp',
            'provinces.name',
            'cities.name'
        )
            ->leftJoin('provinces', 'provinces.id', '=', 'tokos.provinsi')
            ->leftJoin('cities', 'cities.id', '=', 'tokos.kabupaten')
            ->where('tokos.id', Auth::user()->toko_id)->first();
        $penjualan        = Penjualan::cetakPenjualan($request->id_penjualan)->first();
        $detail_penjualan = DetailPenjualan::select([
            'detail_penjualans.jumlah_produk',
            'detail_penjualans.harga_produk',
            'detail_penjualans.diskon',
            'produks.nama_produk',
            'detail_penjualans.id_modifier',
        ])
            ->leftJoin('penjualans', 'penjualans.id', '=', 'detail_penjualans.id_penjualan')
            ->leftJoin('produks', 'produks.produk_id', '=', 'detail_penjualans.id_produk')
            ->where('id_penjualan', $request->id_penjualan)
            ->where('penjualans.toko_id', Auth::user()->toko_id)
            ->groupBy('detail_penjualans.id')
            ->get();
        $total_item   = 0;
        $total_diskon = 0;
        $array        = [];
        foreach ($detail_penjualan as $key => $detail_penjualans) {
            $data = explode(',', $detail_penjualans->id_modifier);
            foreach ($data as $datas) {
                $array_data_modifier   = [];
                $data_id_modifier      = Modifier::select('nama_modifier')->whereId($datas)->first();
                $array_data_modifier[] = $data_id_modifier;
                # code...
            }
            array_push($array, [
                'jumlah_produk' => $detail_penjualans->jumlah_produk,
                'harga_produk'  => $detail_penjualans->harga_produk,
                'nama_produk'   => $detail_penjualans->nama_produk,
                'diskon'        => $detail_penjualans->diskon,
                'id_modifier'   => $detail_penjualans->id_modifier,
                'nama_modifier' => $array_data_modifier,
            ]);
            $total_item += $detail_penjualans->jumlah_produk;
            if ($detail_penjualans->diskon != null) {
                $total_diskon += $detail_penjualans->diskon;
            }
        }
        // return $detail_penjualan;

        return view('penjualan.cetak_penjualan', ['total_item' => $total_item, 'total_diskon' => $total_diskon, 'detail_penjualan' => $array, 'penjualan' => $penjualan, 'nama_toko' => $toko])->with(compact('html'));
    }
    public function cetakPesanan(Request $request)
    {

        $penjualan        = SimpanPenjualan::cetakPesanan($request->id_penjualan)->first();
        $detail_penjualan = SimpanDetailPenjualan::select([
            'simpan_detail_penjualans.jumlah_produk',
            'produks.nama_produk', 'simpan_detail_penjualans.id_modifier',
        ])
            ->leftJoin('simpan_penjualans', 'simpan_penjualans.id', '=', 'simpan_detail_penjualans.id_penjualan')
            ->leftJoin('produks', 'produks.produk_id', '=', 'simpan_detail_penjualans.id_produk')
            ->where('id_penjualan', $request->id_penjualan)
            ->where('simpan_penjualans.toko_id', Auth::user()->toko_id)
            ->groupBy('simpan_detail_penjualans.id')
            ->get();
        $total_item   = 0;
        $total_diskon = 0;
        $array        = [];
        foreach ($detail_penjualan as $key => $detail_penjualans) {
            $data = explode(',', $detail_penjualans->id_modifier);
            foreach ($data as $datas) {
                $array_data_modifier   = [];
                $data_id_modifier      = Modifier::select('nama_modifier')->whereId($datas)->first();
                $array_data_modifier[] = $data_id_modifier;
                # code...
            }
            array_push($array, [
                'jumlah_produk' => $detail_penjualans->jumlah_produk,
                'nama_produk'   => $detail_penjualans->nama_produk,
                'id_modifier'   => $detail_penjualans->id_modifier,
                'nama_modifier' => $array_data_modifier,
            ]);
            $total_item += $detail_penjualans->jumlah_produk;
        }
        // return gettype($detail_penjualans);
        // return $detail_penjualan;
        // return $array;

        return view('penjualan.cetak_pesanan', ['total_item' => $total_item, 'detail_simpan_penjualan' => $array, 'simpan_penjualan' => $penjualan])->with(compact('html'));
    }

    public function dataRiwayatPenjualan(Request $request)
    {
        $hari   = Carbon::now()->toDay();
        $minggu = Carbon::now()->subWeek();
        $bulan  = Carbon::now()->subMonth();
        $tahun  = Carbon::now()->subYear();

        $data_penjualan = Penjualan::riwayatPenjualan($request, $hari, $minggu, $bulan, $tahun)->paginate(10);
        $data_array     = [];
        foreach ($data_penjualan as $data_penjualans) {
            array_push($data_array, ['data_riwayat_penjualan' => $data_penjualans]);
        }
        $link    = 'riwayat-penjualan';
        $respons = $this->dataPagination($data_penjualan, $data_array, $link);
        return response()->json($respons);
    }

    public function detailRiwayatPenjualan(Request $request)
    {
        $detail_penjualan = DetailPenjualan::select([
            'detail_penjualans.jumlah_produk',
            'produks.nama_produk',
        ])
            ->leftJoin('produks', 'produks.produk_id', '=', 'detail_penjualans.id_produk')
            ->leftJoin('penjualans', 'penjualans.id', '=', 'detail_penjualans.id_penjualan')
            ->where('id_penjualan', $request->id)
            ->where('penjualans.toko_id', Auth::user()->toko_id)->get();
        $penjualan = Penjualan::select('penjualans.id',
            'penjualans.pelanggan_id',
            'penjualans.created_at',
            'penjualans.total_bayar',
            'users.nama_pemilik')
            ->leftJoin('users', 'users.id', '=', 'penjualans.created_by')
            ->where('penjualans.id', $request->id)
            ->where('penjualans.toko_id', Auth::user()->toko_id)
            ->first();
        $array = [];
        array_push($array, ['detail_penjualan' => $detail_penjualan, 'penjualan' => $penjualan]);
        return $array;
    }
    // menampilkan kategori produk
    public function kategoriProduk()
    {
        return KategoriProduk::where('toko_id', Auth::user()->toko_id)->get();
    }

    public function hapusTbsPenjualan($id)
    {
        if (TbsPenjualan::destroy($id)) {
            return response('200');
        } else {
            return;
        }

    }
    public function hapusSimpanPenjualan($id)
    {
        if ($id != null) {
            SimpanPenjualan::destroy($id);
            return response('200');
        } else {
            return;
        }

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
