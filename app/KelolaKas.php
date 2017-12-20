<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class KelolaKas extends Model
{
    use AuditableTrait;

    protected $primaryKey = 'kelola_kas_id';
    protected $fillable   = [
        'toko_id', 'type', 'jumlah', 'keterangan',
    ];

    public function kas()
    {
        return $this->belongsTo('App\Kas', 'kas_id', 'id');
    }

    // public function kategoriTransaksi()
    // {
    //     return $this->belongsTo('App\KategoriTransaksi', 'kategori_id', 'id');
    // }
    public function user()
    {
        return $this->belongsTo('App\User', 'toko_id', 'id');
    }
    public function toko()
    {
        return $this->belongsTo('App\Toko', 'toko_id', 'id');
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format(' d F Y H:i:s');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->diffForHumans();
    }
}
