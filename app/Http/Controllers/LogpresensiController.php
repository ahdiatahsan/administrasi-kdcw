<?php

namespace App\Http\Controllers;

use App\Logpresensi;
use App\Agenda;
use App\Presensi;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use illuminate\Database\Eloquent\ModelNotFoundException;

class LogpresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah($presensi)
    {
        $presensis = Presensi::where('id', '=', $presensi)->first();
        $agendas = Agenda::where('id', '=', $presensis->agenda)->first();
        $tanggal = (new Carbon($presensis->created_at))->isoFormat('dddd, D MMMM Y');
        //dd($presensis);
        return view('administrasi.logpresensi.create', compact('presensis', 'agendas', 'tanggal'));
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
            'noreg' => 'required|max:255',
            'presensi' => 'required|max:255',
            'agenda' => 'required|max:255',
            'tanggal' => 'required|max:255'
        ]);

        try {
            $noreg = User::select('id', 'noreg', 'nama')->where('noreg', '=', $request->noreg)->firstorFail();
        } catch (ModelNotFoundException $err) {
            return redirect()->route('logpresensi_tambah', $request->presensi)
                ->with('not_found', 'No. Registrasi Anggota yang Anda masukkan tidak dapat ditemukan.');
        }

        Logpresensi::create([
            'user' => $noreg['id'],
            'presensi' => $request['presensi']
        ]);

        return redirect()->route('logpresensi_tambah', $request->presensi)
            ->withInput()
            ->with('success_absen', 'Presensi oleh ' . $noreg->nama . " (" . $noreg->noreg . ') pada agenda '
                . $request->agenda . ' ( ' . $request->tanggal  . ' ) telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logpresensi  $logpresensi
     * @return \Illuminate\Http\Response
     */
    public function show(Logpresensi $logpresensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Logpresensi  $logpresensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Logpresensi $logpresensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Logpresensi  $logpresensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logpresensi $logpresensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logpresensi  $logpresensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logpresensi $logpresensi)
    {
        //
    }
}
