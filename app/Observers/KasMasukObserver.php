<?php

namespace App\Observers;

use App\KasMasuk;
use App\TransaksiKas;

class KasMasukObserver
{
    public function creating(KasMasuk $KasMasuk)
    {

        TransaksiKas::create(['id' => $KasMasuk->kas_masuk_id, 'jenis_transaksi' => $KasMasuk->type, 'jumlah_masuk' => $KasMasuk->jumlah]);
    }

    public function updating(KasMasuk $KasMasuk)
    {

        TransaksiKas::where('id', $KasMasuk->kas_masuk_id)->update(['jenis_transaksi' => $KasMasuk->type, 'jumlah_masuk' => $KasMasuk->jumlah]);
    }

    public function deleting(KasMasuk $KasMasuk)
    {

        TransaksiKas::where('id', $KasMasuk->kas_masuk_id)->delete();
    }
}
