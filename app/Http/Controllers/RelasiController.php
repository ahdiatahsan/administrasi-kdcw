<?php

namespace App\Http\Controllers;

use App\Relasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class RelasiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('publicRelation')->except('index', 'show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $relasis = Relasi::with('user')->get();

            return DataTables::of($relasis)
                ->addColumn('action', function ($relasi) {
                    return view('relasi.index_action', compact('relasi'))->render();
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('relasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('relasi.create');
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
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
            'kontak' => 'required|max:255',
            'alamat' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'photo' => 'required|file|max:1024|mimes:jpeg,jpg,png,webp'
        ]);

        $created_by = Auth::user()->id;

        $photoFile = $request->file('photo');
        $photoName = Str::slug($request['nama']) . '.' . $photoFile->getClientOriginalExtension();

        Relasi::create([
            'nama' => $request['nama'],
            'email' => $request['email'],
            'kontak' => $request['kontak'],
            'alamat' => $request['alamat'],
            'keterangan' => $request['keterangan'],
            'created_by' => $created_by,
            'logo' => $photoName
        ]);

        Storage::putFileAs('public/relasi', $photoFile, $photoName);

        return redirect()->route('relasi.index')->with('success', 'Data relasi dengan ' . $request['nama'] . ' telah ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function show(Relasi $relasi)
    {
        return view('relasi.show', compact('relasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Relasi $relasi)
    {
        return view('relasi.edit', compact('relasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relasi $relasi)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
            'kontak' => 'required|max:255',
            'alamat' => 'required|max:255',
            'keterangan' => 'required|max:255'
        ]);

        if ($request->file('photo') != null) {
            $request->validate([
                'photo' => 'required|file|max:1024|mimes:jpeg,jpg,png,webp'
            ]);

            if (Storage::exists('public/relasi/' . $relasi->logo)) {
                Storage::delete('public/relasi/' . $relasi->logo);
            }

            $photoFile = $request->file('photo');
            $photoName = Str::slug($request['nama']) . '.' . $photoFile->getClientOriginalExtension();

            $relasi->logo = $photoName;
        }

        $relasi->nama = $request['nama'];
        $relasi->email = $request['email'];
        $relasi->kontak = $request['kontak'];
        $relasi->alamat = $request['alamat'];
        $relasi->keterangan = $request['keterangan'];
        $relasi->save();

        if ($request->file('photo') != null) {
            Storage::putFileAs('public/relasi', $photoFile, $photoName);
        }

        return redirect()->route('relasi.index')->with('success', 'Data relasi dengan ' . $request['old_nama'] . ' telah diubah menjadi ' . $request['nama'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relasi $relasi)
    {
        $relasi->delete();

        if (Storage::exists('public/relasi/' . $relasi->logo)) {
            Storage::delete('public/relasi/' . $relasi->logo);
        }

        return redirect()->route('relasi.index')->with('success', 'Data relasi dengan ' . $relasi->nama . ' telah dihapus.');
    }
}
