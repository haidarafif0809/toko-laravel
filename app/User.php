<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Yajra\Auditable\AuditableTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use AuditableTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'toko_id', 'nama_pemilik', 'email', 'no_telp', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format(' d F Y H:i:s');
    }
    public function getCreatedAtAttributes()
    {
        return \Carbon\Carbon::parse($this->attributes['last_login'])
            ->format(' d F Y H:i:s');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->diffForHumans();
    }

    public function toko()
    {
        return $this->belongsTo('App\Toko');
    }

    public function setBirthDateAttribute($date)
    {
        $this->attributes['last_login'] = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->toDateString();
    }
    public function getBirthDateAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }
}
