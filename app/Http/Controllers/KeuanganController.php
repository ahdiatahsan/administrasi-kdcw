<?php

namespace App\Http\Controllers;

use App\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keuangans = Keuangan::with('user')->get();

            return DataTables::of($keuangans)
                ->editColumn('jenis_dana', function ($keuangan) {
                    return view('keuangan.index_type', compact('keuangan'))->render();
                })
                ->addColumn('action', function ($keuangan) {
                    return view('keuangan.index_action', compact('keuangan'))->render();
                })
                ->addIndexColumn()
                ->rawColumns(['jenis_dana', 'action'])
                ->make(true);
        }
        return view('keuangan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keuangan.create');
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
            'keterangan' => 'required|max:255',
            'nominal' => 'required|numeric',
            'jenis_dana' => 'required',
            'photo' => 'required|file|max:2048|mimes:jpeg,jpg,png,webp'
        ]);

        $photoFile = $request->file('photo');
        $photoName = Str::slug($request['keterangan']) . '.' . $photoFile->getClientOriginalExtension();

        Keuangan::create([
            'keterangan' => $request['keterangan'],
            'nominal' => $request['nominal'],
            'jenis_dana' => $request['jenis_dana'],
            'created_by' => '1',
            'nota' => $photoName
        ]);

        Storage::putFileAs('public/keuangan', $photoFile, $photoName);

        return redirect()->route('keuangan.index')->with('success', 'Data keuangan : ' . $request['keterangan'] . ' telah ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function show(Keuangan $keuangan)
    {
        return view('keuangan.show', compact('keuangan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Keuangan $keuangan)
    {
        return view('keuangan.edit', compact('keuangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keuangan $keuangan)
    {
        $request->validate([
            'keterangan' => 'required|max:255',
            'nominal' => 'required|numeric',
            'jenis_dana' => 'required',
        ]);

        if ($request->file('photo') != null) {
            $request->validate([
                'photo' => 'required|file|max:2048|mimes:jpeg,jpg,png,webp'
            ]);

            if (Storage::exists('public/keuangan/' . $keuangan->nota)) {
                Storage::delete('public/keuangan/' . $keuangan->nota);
            }

            $photoFile = $request->file('photo');
            $photoName = Str::slug($request['keterangan']) . '.' . $photoFile->getClientOriginalExtension();

            $keuangan->nota = $photoName;
        }

        $keuangan->keterangan = $request['keterangan'];
        $keuangan->nominal = $request['nominal'];
        $keuangan->jenis_dana = $request['jenis_dana'];
        $keuangan->save();

        if ($request->file('photo') != null) {
            Storage::putFileAs('public/keuangan', $photoFile, $photoName);
        }

        return redirect()->route('keuangan.index')->with('success', 'Data keuangan : ' . $request['old_keterangan'] . ' telah diubah menjadi ' . $request['keterangan'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();

        if (Storage::exists('public/keuangan/' . $keuangan->nota)) {
            Storage::delete('public/keuangan/' . $keuangan->nota);
        }

        return redirect()->route('keuangan.index')->with('success', 'Data keuangan : ' . $keuangan->keterangan . ' telah dihapus.');
    }
}
