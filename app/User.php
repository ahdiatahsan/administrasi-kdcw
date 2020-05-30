<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password', 'jabatan', 'email', 'kontak', 'noreg', 'status_surat', 'foto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    # Has relationship
    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan', 'jabatan');
    }

    public function persuratan()
    {
        return $this->hasMany('App\Persuratan', 'created_by');
    }

    public function databarang()
    {
        return $this->hasMany('App\Databarang', 'created_by');
    }

    public function peminjaman()
    {
        return $this->hasMany('App\Peminjaman', 'created_by');
    }

    public function keuangan()
    {
        return $this->hasMany('App\Keuangan', 'created_by');
    }

    public function relasi()
    {
        return $this->hasMany('App\Relasi', 'created_by');
    }
    
}
