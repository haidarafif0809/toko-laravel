<?php

namespace App\Observers;

use App\KasMasuk;
use App\TransaksiKas;

class KasMasukObserver
{
    public function creating(KasMasuk $KasMasuk)
    {

        TransaksiKas::create(['id' => $KasMasuk->kas_masuk_id, 'jenis_transaksi' => 'kas_masuk', 'jumlah_masuk' => $KasMasuk->jumlah, 'kas' => $KasMasuk->kas_id, 'kategori_transaksi' => $KasMasuk->kategori_id]);
    }

    public function updating(KasMasuk $KasMasuk)
    {

        TransaksiKas::where('id', $KasMasuk->kas_masuk_id)->update(['jumlah_masuk' => $KasMasuk->jumlah, 'kas' => $KasMasuk->kas_id, 'kategori_transaksi' => $KasMasuk->kategori_id]);
    }

    public function deleting(KasMasuk $KasMasuk)
    {

        TransaksiKas::where('id', $KasMasuk->kas_masuk_id)->delete();
    }
}
