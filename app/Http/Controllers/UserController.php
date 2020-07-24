<?php

namespace App\Http\Controllers;

use App\User;
use App\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('jabatans')->get();

            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return view('administrasi.anggota.index_action', compact('user'))->render();
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('administrasi.anggota.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatans = Jabatan::orderBy('id')->get();
        return view('administrasi.anggota.create', compact('jabatans'));
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
            'password' => 'required|min:8|confirmed',
            'jabatan' => 'required|max:255',
            'kontak' => 'required|max:255',
            'noreg' => 'required|max:255',
            'alamat' => 'required|max:255',
            'surat' => 'required|max:255',
            'photo' => 'required|file|max:2048|mimes:jpeg,jpg,png,webp'
        ]);

        $photoFile = $request->file('photo');
        $photoName = Str::slug($request['nama']) . '.' . $photoFile->getClientOriginalExtension();

        User::create([
            'nama' => $request['nama'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'jabatan' => $request['jabatan'],
            'kontak' => $request['kontak'],
            'noreg' => $request['noreg'],
            'alamat' => $request['alamat'],
            'status_surat' => $request['surat'],
            'foto' => $photoName
        ]);

        Storage::putFileAs('public/user', $photoFile, $photoName);

        return redirect()->route('anggota.index')->with('success', 'Data anggota ' . $request['nama'] . ' ( '. $request['noreg'] .' )' . ' telah ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $jabatans = User::with('jabatans')->get();
        return view('administrasi.anggota.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $jabatans = Jabatan::orderBy('id')->get();
        $selectedJabatan = User::select('jabatan')
            ->where('jabatan', '=', $user->jabatan)->first();
        return view('administrasi.anggota.edit', compact('user', 'jabatans', 'selectedJabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
            'jabatan' => 'required|max:255',
            'kontak' => 'required|max:255',
            'alamat' => 'required|max:255',
            'noreg' => 'required|max:255',
            'surat' => 'required|max:255'
        ]);

        if ($request->file('photo') != null) {
            $request->validate([
                'photo' => 'required|file|max:2048|mimes:jpeg,jpg,png,webp'
            ]);

            if (Storage::exists('public/user/' . $user->foto)) {
                Storage::delete('public/user/' . $user->foto);
            }

            $photoFile = $request->file('photo');
            $photoName = Str::slug($request['nama']) . '.' . $photoFile->getClientOriginalExtension();

            $user->foto = $photoName;
        }

        $user->nama = $request['nama'];
        $user->email = $request['email'];
        $user->jabatan = $request['jabatan'];
        $user->kontak = $request['kontak'];
        $user->alamat = $request['alamat'];
        $user->noreg = $request['noreg'];
        $user->status_surat = $request['surat'];
        $user->save();

        if ($request->file('photo') != null) {
            Storage::putFileAs('public/user', $photoFile, $photoName);
        }

        return redirect()->route('anggota.index')->with('success', 'Data anggota ' . $request['old_nama'] . ' telah diubah menjadi ' . $request['nama'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        if (Storage::exists('public/user/' . $user->foto)) {
            Storage::delete('public/user/' . $user->foto);
        }

        return redirect()->route('anggota.index')->with('success', 'Data anggota ' . $user->nama . ' ( '. $user->noreg .' )' .' telah dihapus.');
    }
}
