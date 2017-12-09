<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class KasMasuk extends Model
{
    use AuditableTrait;

    protected $primaryKey = 'kas_masuk_id';
    protected $fillable   = [
        'type', 'jumlah', 'keterangan',
    ];

    public function kas()
    {
        return $this->belongsTo('App\Kas', 'kas_id', 'id');
    }

    public function kategoriTransaksi()
    {
        return $this->belongsTo('App\KategoriTransaksi', 'kategori_id', 'id');
    }
}
