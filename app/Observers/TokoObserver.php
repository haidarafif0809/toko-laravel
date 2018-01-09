<?php

namespace App\Observers;

use App\Toko;
use App\User;

class TokoObserver
{
    public function updating(Toko $toko)
    {
        User::where('toko_id', $toko->id)->where('type', 1)->update(['nama_pemilik' => $toko->nama_pemilik, 'email' => $toko->email, 'no_telp' => $toko->no_telp]);
    }

    public function deleting(Toko $toko)
    {
        User::where('toko_id', $toko->id)->delete();
        return true;
    }
}
