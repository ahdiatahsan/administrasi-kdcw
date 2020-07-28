<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekapan extends Model
{
    protected $table = 'rekapans';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_barang', 
        'peminjam', 
        'jumlah',
        'tanggal_pinjam', 
        'tanggal_kembali',
        'keterangan',
        'diterima_oleh'
    ];
}
