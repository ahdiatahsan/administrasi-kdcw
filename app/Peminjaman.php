<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'barang_id', 
        'peminjam', 
        'jumlah',
        'tanggal_pinjam',
        'keterangan',
        'created_by'
    ];

    public function barang()
    {
        return $this->belongsTo('App\Databarang', 'barang_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
