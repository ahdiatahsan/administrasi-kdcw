<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_barang', 
        'peminjam', 
        'jumlah', 
        'tanggal_kembali',
        'created_by',
        'accepted_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
