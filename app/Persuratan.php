<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persuratan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_surat', 
        'judul', 
        'dari_kepada', 
        'tanggal',
        'jenis_surat', 
        'foto',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
