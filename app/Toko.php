<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Yajra\Auditable\AuditableTrait;

class Toko extends Model
{

    use LaratrustUserTrait;
    use AuditableTrait;
    use Notifiable;
    protected $fillable = [
        'nama_toko', 'nama_pemilik', 'email', 'no_telp', 'provinsi', 'kabupaten', 'alamat', 'prefix_member_id', 'foto',
    ];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format(' d-m-Y ');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->diffForHumans();
    }

    public function user()
    {
        return $this->hasMany('App\User');
    }
    public function stafToko()
    {
        return $this->hasMany('App\StafToko');
    }
}
