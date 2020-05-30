<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relasi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 
        'alamat', 
        'email', 
        'kontak',
        'logo', 
        'keterangan',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
