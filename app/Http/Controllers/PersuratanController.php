<?php

namespace App\Http\Controllers;

use App\Persuratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PersuratanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('sekretaris')->except('index', 'show', 'surat_masuk', 'surat_keluar');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrasi.persuratan.index');
    }

    /**
     * Fungsi tabel persuratan -> surat masuk.
     *
     * @return \Illuminate\Http\Response
     */
    public function surat_masuk(Request $request)
    {
        if ($request->ajax()) {
            $persuratans = Persuratan::with('user')->where('jenis_surat', '=', 'Surat Masuk')->get();

            return DataTables::of($persuratans)
                ->addColumn('action', function ($persuratan) {
                    return view('administrasi.persuratan.index_action', compact('persuratan'))->render();
                })
                ->editColumn('tanggal', function ($persuratan) {
                    return $persuratan->tanggal ? with(new Carbon($persuratan->tanggal))->format('d-m-Y') : '';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Fungsi tabel persuratan -> surat masuk.
     *
     * @return \Illuminate\Http\Response
     */
    public function surat_keluar(Request $request)
    {
        if ($request->ajax()) {
            $persuratans = Persuratan::with('user')->where('jenis_surat', '=', 'Surat Keluar')->get();

            return DataTables::of($persuratans)
                ->addColumn('action', function ($persuratan) {
                    return view('administrasi.persuratan.index_action', compact('persuratan'))->render();
                })
                ->editColumn('tanggal', function ($persuratan) {
                    return $persuratan->tanggal ? with(new Carbon($persuratan->tanggal))->format('d-m-Y') : '';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrasi.persuratan.create');
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
            'no_surat' => 'required|max:255',
            'judul' => 'required|max:255',
            'jenis_surat' => 'required|max:255',
            'dari_kepada' => 'required|max:255',
            'tanggal' => 'required|max:255',
            'photo' => 'required|file|max:2048|mimes:jpeg,jpg,png,webp'
        ]);

        $created_by = Auth::user()->id;

        $photoFile = $request->file('photo');
        $photoName = Str::slug($request['no_surat']) . '.' . $photoFile->getClientOriginalExtension();

        Persuratan::create([
            'no_surat' => $request['no_surat'],
            'judul' => $request['judul'],
            'jenis_surat' => $request['jenis_surat'],
            'dari_kepada' => $request['dari_kepada'],
            'tanggal' => Carbon::parse($request['tanggal'])->toDateString(),
            'created_by' => $created_by,
            'foto' => $photoName
        ]);

        Storage::putFileAs('public/administrasi', $photoFile, $photoName);

        return redirect()->route('persuratan.index')->with('success', 'Data surat ' . $request['no_surat'] . ' telah ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persuratan  $persuratan
     * @return \Illuminate\Http\Response
     */
    public function show(Persuratan $persuratan)
    {
        return view('administrasi.persuratan.show', compact('persuratan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persuratan  $persuratan
     * @return \Illuminate\Http\Response
     */
    public function edit(Persuratan $persuratan)
    {
        return view('administrasi.persuratan.edit', compact('persuratan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persuratan  $persuratan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persuratan $persuratan)
    {
        $request->validate([
            'no_surat' => 'required|max:255',
            'judul' => 'required|max:255',
            'jenis_surat' => 'required|max:255',
            'dari_kepada' => 'required|max:255',
            'tanggal' => 'required|max:255'
        ]);

        if ($request->file('photo') != null) {
            $request->validate([
                'photo' => 'required|file|max:2048|mimes:jpeg,jpg,png,webp'
            ]);

            if (Storage::exists('public/administrasi/' . $persuratan->foto)) {
                Storage::delete('public/administrasi/' . $persuratan->foto);
            }

            $photoFile = $request->file('photo');
            $photoName = Str::slug($request['no_surat']) . '.' . $photoFile->getClientOriginalExtension();

            $persuratan->foto = $photoName;
        }

        $persuratan->no_surat = $request['no_surat'];
        $persuratan->judul = $request['judul'];
        $persuratan->jenis_surat = $request['jenis_surat'];
        $persuratan->dari_kepada = $request['dari_kepada'];
        $persuratan->tanggal = Carbon::parse($request['tanggal'])->toDateString();
        $persuratan->save();

        if ($request->file('photo') != null) {
            Storage::putFileAs('public/administrasi', $photoFile, $photoName);
        }

        return redirect()->route('persuratan.index')->with('success', 'Data surat ' . $request['old_no_surat'] . ' telah diubah menjadi ' . $request['no_surat'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persuratan  $persuratan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persuratan $persuratan)
    {
        $persuratan->delete();

        if (Storage::exists('public/administrasi/' . $persuratan->foto)) {
            Storage::delete('public/administrasi/' . $persuratan->foto);
        }

        return redirect()->route('persuratan.index')->with('success', 'Data surat ' . $persuratan->no_surat . ' telah dihapus.');
    }
}
