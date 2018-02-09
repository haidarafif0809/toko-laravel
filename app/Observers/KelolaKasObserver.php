<?php

namespace App\Observers;

use App\KelolaKas;
use App\TransaksiKas;

class KelolaKasObserver
{
    // created setelah data observer terinsert but, creating insert terlebih dahulu
    public function created(KelolaKas $KelolaKas)
    {
        if ($KelolaKas->type == 1) {

            TransaksiKas::create(['id_transaksi' => $KelolaKas->kelola_kas_id, 'toko_id' => $KelolaKas->toko_id, 'jenis_transaksi' => $KelolaKas->type, 'jumlah_masuk' => $KelolaKas->jumlah]);
        } else {
            TransaksiKas::create(['id_transaksi' => $KelolaKas->kelola_kas_id, 'toko_id' => $KelolaKas->toko_id, 'jenis_transaksi' => $KelolaKas->type, 'jumlah_keluar' => $KelolaKas->jumlah]);
        }
    }

    public function updating(KelolaKas $KelolaKas)
    {
        if ($KelolaKas->type == 1) {
            TransaksiKas::where('id_transaksi', $KelolaKas->kelola_kas_id)->update(['jumlah_masuk' => $KelolaKas->jumlah]);
        } else {
            TransaksiKas::where('id_transaksi', $KelolaKas->kelola_kas_id)->update(['jumlah_keluar' => $KelolaKas->jumlah]);
        }
    }

    public function deleting(KelolaKas $KelolaKas)
    {
        TransaksiKas::where('id_transaksi', $KelolaKas->kelola_kas_id)->delete();
    }
}
