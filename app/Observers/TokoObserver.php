<?php

namespace App\Observers;

use App\Toko;
use App\User;

class TokoObserver
{
    public function updating(Toko $Toko)
    {
        User::where('toko_id', $Toko->id)->update(['nama_pemilik' => $Toko->nama_pemilik, 'email' => $Toko->email, 'no_telp' => $Toko->no_telp]);
    }

    public function deleting(Toko $Toko)
    {
        User::where('toko_id', $Toko->id)->delete();
        return true;
    }
}
