<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agenda', 'catatan', 'created_by'
    ];

    public function agenda()
    {
        return $this->belongsTo('App\Agenda', 'agenda');
    }

    public function logpresensi()
    {
        return $this->hasMany('App\Logpresensi', 'presensi');
    }
}
