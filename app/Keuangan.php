<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_dana', 
        'nominal', 
        'keterangan', 
        'nota',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
