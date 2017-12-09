<?php

namespace App\Observers;

use App\KasMasuk;
use App\TransaksiKas;

class KasMasukObserver
{
    public function creating(KasMasuk $KasMasuk)
    {
        if ($KasMasuk->type == 1) {

            TransaksiKas::create(['id' => $KasMasuk->kas_masuk_id, 'jenis_transaksi' => $KasMasuk->type, 'jumlah_masuk' => $KasMasuk->jumlah]);
        } else {
            TransaksiKas::create(['id' => $KasMasuk->kas_masuk_id, 'jenis_transaksi' => $KasMasuk->type, 'jumlah_keluar' => $KasMasuk->jumlah]);
        }
    }

    public function updating(KasMasuk $KasMasuk)
    {
        if ($KasMasuk->type == 1) {
            TransaksiKas::where('id', $KasMasuk->kas_masuk_id)->update(['jumlah_masuk' => $KasMasuk->jumlah]);
        } else {
            TransaksiKas::where('id', $KasMasuk->kas_masuk_id)->update(['jumlah_keluar' => $KasMasuk->jumlah]);
        }
    }

    public function deleting(KasMasuk $KasMasuk)
    {
        TransaksiKas::where('id', $KasMasuk->kas_masuk_id)->delete();
    }
}
