<?php

namespace App\Observers;

use App\KelolaKas;
use App\TransaksiKas;

class KelolaKasObserver
{
    public function creating(KelolaKas $KelolaKas)
    {
        if ($KelolaKas->type == 1) {

            TransaksiKas::create(['id' => $KelolaKas->kelola_kas_id, 'jenis_transaksi' => $KelolaKas->type, 'jumlah_masuk' => $KelolaKas->jumlah]);
        } else {
            TransaksiKas::create(['id' => $KelolaKas->kelola_kas_id, 'jenis_transaksi' => $KelolaKas->type, 'jumlah_keluar' => $KelolaKas->jumlah]);
        }
    }

    public function updating(KelolaKas $KelolaKas)
    {
        if ($KelolaKas->type == 1) {
            TransaksiKas::where('id', $KelolaKas->kelola_kas_id)->update(['jumlah_masuk' => $KelolaKas->jumlah]);
        } else {
            TransaksiKas::where('id', $KelolaKas->kelola_kas_id)->update(['jumlah_keluar' => $KelolaKas->jumlah]);
        }
    }

    public function deleting(KelolaKas $KelolaKas)
    {
        TransaksiKas::where('id', $KelolaKas->kelola_kas_id)->delete();
    }
}
