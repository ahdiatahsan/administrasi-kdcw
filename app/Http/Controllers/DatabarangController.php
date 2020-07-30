<?php

namespace App\Http\Controllers;

use App\Databarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class DatabarangController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('toolsProperties')->except('index', 'show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $barangs = Databarang::with('user')->get();

            return DataTables::of($barangs)
                ->editColumn('total', function ($barang) {
                    $total = Databarang::where('id', '=', $barang->id)->value(DB::raw("SUM(tersedia + dipinjam)"));
                    return $total;
                })
                ->addColumn('action', function ($barang) {
                    return view('inventaris.barang.index_action', compact('barang'))->render();
                })
                ->addIndexColumn()
                ->rawColumns(['total', 'action'])
                ->make(true);
        }
        return view('inventaris.barang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventaris.barang.create');
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
            'kondisi' => 'required|max:255',
            'jumlah' => 'required|numeric|min:1',
            'photo' => 'required|file|max:1024|mimes:jpeg,jpg,png,webp'
        ]);

        $created_by = Auth::user()->id;

        $photoFile = $request->file('photo');
        $photoName = Str::slug($request['nama']) . '.' . $photoFile->getClientOriginalExtension();

        Databarang::create([
            'nama' => $request['nama'],
            'kondisi' => $request['kondisi'],
            'tersedia' => $request['jumlah'],
            'dipinjam' => '0',
            'created_by' => $created_by,
            'foto' => $photoName
        ]);

        Storage::putFileAs('public/inventaris', $photoFile, $photoName);

        return redirect()->route('barang.index')->with('success', 'Data barang ' . $request['nama'] . ' telah ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Databarang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Databarang $barang)
    {
        $total = Databarang::where('id', '=', $barang->id)->value(DB::raw("SUM(tersedia + dipinjam)"));
        return view('inventaris.barang.show', compact('barang', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Databarang  $databarang
     * @return \Illuminate\Http\Response
     */
    public function edit(Databarang $barang)
    {
        return view('inventaris.barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Databarang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Databarang $barang)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'kondisi' => 'required|max:255',
            'jumlah' => 'required|numeric|min:0'
        ]);

        if ($request->file('photo') != null) {
            $request->validate([
                'photo' => 'required|file|max:1024|mimes:jpeg,jpg,png,webp'
            ]);

            if (Storage::exists('public/inventaris/' . $barang->foto)) {
                Storage::delete('public/inventaris/' . $barang->foto);
            }

            $photoFile = $request->file('photo');
            $photoName = Str::slug($request['nama']) . '.' . $photoFile->getClientOriginalExtension();

            $barang->foto = $photoName;
        }

        $barang->nama = $request['nama'];
        $barang->kondisi = $request['kondisi'];
        $barang->tersedia = $request['jumlah'];
        $barang->save();

        if ($request->file('photo') != null) {
            Storage::putFileAs('public/inventaris', $photoFile, $photoName);
        }

        return redirect()->route('barang.index')->with('success', 'Data barang ' . $request['old_nama'] . ' telah diubah menjadi ' . $request['nama'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Databarang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Databarang $barang)
    {
        $barang->delete();

        if (Storage::exists('public/inventaris/' . $barang->foto)) {
            Storage::delete('public/inventaris/' . $barang->foto);
        }

        return redirect()->route('barang.index')->with('success', 'Data barang ' . $barang->nama . ' telah dihapus.');
    }
}
