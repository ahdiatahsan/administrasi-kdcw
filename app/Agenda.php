<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'nama'
    ];

    public function presensi()
    {
        return $this->hasMany('App\Presensi', 'agenda');
    }
}
