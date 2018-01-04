<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Yajra\Auditable\AuditableTrait;
use Illuminate\Support\Facades\Mail;

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

    protected $casts = [
        'status' => 'boolean',
    ];
    protected $fillable = [
        'type', 'toko_id', 'nama_pemilik', 'email', 'no_telp', 'password', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendVerification()
    {
        $user = $this;
        $token = str_random(40);
        $user->verification_token = $token;
        $user->save();
        Mail::send('auth.emails.verification', compact('user', 'token'), function ($message) use ($user) {
            $message->to($user->email, $user->name)->subject('Verifikasi Akun Toko Dasar');
        });
    }
    public function sendVerificationStaff()
    {
        $user = $this;
        $token = str_random(40);
        $user->verification_token = $token;
        $user->save();
        Mail::send('auth.emails.verificationStaff', compact('user', 'token'), function ($message) use ($user) {
            $message->to($user->email, $user->nama_pemilik)->subject('Verifikasi Akun Toko Dasar');
        });
    }

    public function verify()
    {
        $this->status = 1;
        $this->verification_token = null;
        $this->save();
    }



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
