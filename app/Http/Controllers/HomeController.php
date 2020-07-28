<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //administrasi
        $persuratan = DB::table('persuratans')->count();
        $anggota = DB::table('users')->count();

        //inventaris
        $barang = DB::table('databarangs')->count();
        $peminjaman = DB::table('peminjamans')->count();

        //relasi
        $relasi = DB::table('relasis')->count();

        //keuangan
        $dana_masuk = DB::table('keuangans')->where('jenis_dana', '=', 'Dana Masuk')->value(DB::raw("SUM(nominal)"));
        $dana_keluar = DB::table('keuangans')->where('jenis_dana', '=', 'Dana Keluar')->value(DB::raw("SUM(nominal)"));
        $saldo = $dana_masuk - $dana_keluar;

        return view('home', compact(
            'persuratan',
            'anggota',
            'barang',
            'peminjaman',
            'relasi',
            'saldo'
        ));
    }
}
