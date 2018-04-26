<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

    public function scopeLaporanKas($query, $waktu)
    {
        $query->select([
            DB::raw('kelola_kas.created_at as tanggal'),
            'kelola_kas.kelola_kas_id as id_kelola_kas',
            'kelola_kas.toko_id',
            'kelola_kas.type',
            'kelola_kas.jumlah',
            'kelola_kas.keterangan',
            'users.nama_pemilik',
        ])
            ->leftJoin('users', 'users.id', '=', 'kelola_kas.created_by')
            ->where('kelola_kas.toko_id', Auth::user()->toko_id)
            ->where('.kelola_kas.created_at', '>=', $waktu)
            ->groupBy('kelola_kas.kelola_kas_id');
        return $query;
    }
}
