<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Databarang extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 
        'kondisi', 
        'tersedia', 
        'dipinjam', 
        'foto',
        'created_by'
    ];

    public function peminjaman()
    {
        return $this->hasMany('App\Peminjaman', 'kode_barang');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
