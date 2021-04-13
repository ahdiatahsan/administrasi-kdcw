<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logpresensi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'user', 'presensi'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user');
    }

    public function presensi()
    {
        return $this->belongsTo('App\Presensi', 'presensi');
    }
}
