<?php

namespace App\Http\Controllers;

use App\Databarang;
use App\Peminjaman;
use App\Rekapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $peminjamans = Peminjaman::with('barang', 'user')->get();

            return DataTables::of($peminjamans)
                ->addColumn('action', function ($peminjaman) {
                    return view('inventaris.peminjaman.index_action', compact('peminjaman'))->render();
                })
                ->editColumn('tanggal_pinjam', function ($peminjaman) {
                    return $peminjaman->tanggal_pinjam ? with(new Carbon($peminjaman->tanggal_pinjam))->format('d-m-Y') : '';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('inventaris.peminjaman.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rekap(Request $request)
    {
        if ($request->ajax()) {
            $rekapans = Rekapan::all();
            return DataTables::of($rekapans)
                ->editColumn('tanggal_pinjam', function ($rekapan) {
                    return $rekapan->tanggal_pinjam ? with(new Carbon($rekapan->tanggal_pinjam))->format('d-m-Y') : '';
                })
                ->editColumn('tanggal_kembali', function ($rekapan) {
                    return $rekapan->tanggal_kembali ? with(new Carbon($rekapan->tanggal_kembali))->format('d-m-Y') : '';
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('inventaris.peminjaman.rekap');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barangs = Databarang::where('tersedia', '>', 0)->orderBy('id')->get();
        return view('inventaris.peminjaman.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang' => 'required',
            'peminjam' => 'required|max:255',
            'jumlah' => 'required|numeric|lte:tersedia|min:1',
            'tanggal' => 'required|max:255',
            'keterangan' => 'required|max:255'
        ],
            [
                'jumlah.lte' => 'Jumlah barang yang dipinjam harus lebih kecil (bukan nol)
                                 atau sama dengan jumlah barang yang tersedia.'
            ]);
        
        $update_barang = Databarang::where('id', '=', $request->barang)->first();
        $update_barang->tersedia = $update_barang->tersedia - $request->jumlah;
        $update_barang->dipinjam = $update_barang->dipinjam + $request->jumlah;
        $update_barang->save();

        Peminjaman::create([
            'barang_id' => $request['barang'],
            'peminjam' => $request['peminjam'],
            'jumlah' => $request['jumlah'],
            'tanggal_pinjam' => Carbon::parse($request['tanggal'])->toDateString(),
            'keterangan' => $request['keterangan'],
            'created_by' => '1'
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman barang ' . $update_barang->nama . ' telah ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        $peminjamans = Peminjaman::with('barang')->where('id', '=', $peminjaman->id)->first();
        return view('inventaris.peminjaman.show', compact('peminjamans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $peminjaman)
    {
        $barang = Databarang::where('id', '=', $peminjaman->barang_id)->first();
        $dipinjam = $peminjaman->jumlah;
        $batas = $barang->tersedia + $dipinjam;
        return view('inventaris.peminjaman.edit', compact('peminjaman', 'barang', 'batas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'peminjam' => 'required|max:255',
            'jumlah' => 'required|numeric|lte:batas|min:1',
            'tanggal' => 'required|max:255',
            'keterangan' => 'required|max:255'
        ],
            [
                'jumlah.lte' => 'Jumlah barang yang dipinjam harus lebih kecil (bukan nol)
                                 atau sama dengan batas ubah jumlah barang.'
            ]);

        $update_barang = Databarang::where('id', '=', $peminjaman->barang_id)->first();
        $update_barang->tersedia = $update_barang->tersedia - ($request->jumlah - $request->old_jumlah);
        $update_barang->dipinjam = $update_barang->dipinjam + ($request->jumlah - $request->old_jumlah);
        $update_barang->save();

        $peminjaman->peminjam = $request['peminjam'];
        $peminjaman->jumlah = $request['jumlah'];
        $peminjaman->tanggal_pinjam = Carbon::parse($request['tanggal'])->toDateString();
        $peminjaman->keterangan = $request['keterangan'];
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman barang ' . $update_barang->nama . 
            ' oleh '. $request->peminjam .' telah diubah.');
    }

    /**
     * Tampilkan form kembalikan barang dipinjam.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function kembalikan_view(Peminjaman $peminjaman)
    {
        $barang = Databarang::where('id', '=', $peminjaman->barang_id)->first();
        return view('inventaris.peminjaman.kembalikan', compact('peminjaman', 'barang'));
    }

    /**
     * Hapus data pada tabel peminjaman dan masukkan data pada tabel rekap.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function kembalikan_store(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'peminjam' => 'required|max:255',
            'jumlah' => 'required|numeric|min:1',
            'tanggal_pinjam' => 'required|max:255',
            'tanggal_kembali' => 'required|max:255',
            'keterangan' => 'required|max:255'
        ]);
        
        $update_barang = Databarang::where('id', '=', $request->barang_id)->first();
        $update_barang->tersedia = $update_barang->tersedia + $request->jumlah;
        $update_barang->dipinjam = $update_barang->dipinjam - $request->jumlah;
        $update_barang->save();

        Rekapan::create([
            'nama_barang' => $request['nama'],
            'peminjam' => $request['peminjam'],
            'jumlah' => $request['jumlah'],
            'tanggal_pinjam' => Carbon::parse($request['tanggal_pinjam'])->toDateString(),
            'tanggal_kembali' => Carbon::parse($request['tanggal_kembali'])->toDateString(),
            'keterangan' => $request['keterangan'],
            'diterima_oleh' => '1'
        ]);

        $peminjaman->delete();

        return redirect()->route('rekap_peminjaman')->with('success', 'Barang ' . $request->nama . ' 
            yang dipinjam oleh '. $request->peminjam .' telah dikembalikan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjamans = Peminjaman::with('barang')->where('id', '=', $peminjaman->id)->first();

        $update_barang = Databarang::where('id', '=', $peminjaman->barang_id)->first();
        $update_barang->tersedia = $update_barang->tersedia + $peminjaman->jumlah;
        $update_barang->dipinjam = $update_barang->dipinjam - $peminjaman->jumlah;
        $update_barang->save();

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman barang ' . $peminjamans->barang->nama . 
                                                           ' oleh '. $peminjaman->peminjam .' telah dihapus.');
    }
}
