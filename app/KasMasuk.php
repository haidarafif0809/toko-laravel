<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class KasMasuk extends Model
{
    use AuditableTrait;

    protected $primaryKey = 'kas_masuk_id';
    protected $fillable   = [
        'kas_id', 'kategori_id', 'jumlah', 'keterangan',
    ];

    public function kas()
    {
        return $this->hasOne('App\Kas', 'id', 'kas_masuk_id');
    }

    public function kategoriTransaksi()
    {
        return $this->hasOne('App\KategoriTransaksi', 'id', 'kas_masuk_id');
    }
}
