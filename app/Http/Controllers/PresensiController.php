<?php

namespace App\Http\Controllers;

use App\Logpresensi;
use App\Presensi;
use App\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class PresensiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('sekretaris')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = Agenda::orderBy('id')->get();
        return view('administrasi.presensi.index', compact('agendas'));
    }

    /**
     * Fungsi tabel presensi -> agenda yang dijalankan.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar_agenda(Request $request)
    {
        if ($request->ajax()) {

            if (!empty($request->filter_agenda)) {
                $presensis = Presensi::with('agenda')
                    ->where('agenda', '=', $request->filter_agenda)
                    ->get();
            } else {
                $presensis = Presensi::with('agenda')
                    ->get();
            }

            return DataTables::of($presensis)
                ->addColumn('action', function ($presensi) {
                    return view('administrasi.presensi.index_action', compact('presensi'))->render();
                })
                ->editColumn('created_at', function ($presensi) {
                    return $presensi->created_at ? with(new Carbon($presensi->created_at))->isoFormat('dddd, D MMMM Y') : '';
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
        $agendas = Agenda::orderBy('id')->get();
        return view('administrasi.presensi.create', compact('agendas'));
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
            'agenda' => 'required|max:255',
            'catatan' => 'required',
        ]);

        $created_by = Auth::user()->id;

        $agenda = Agenda::findOrFail($request->agenda);
        $agenda_nama = Agenda::select('nama')->where('id', '=', $agenda->id)->get();

        Presensi::create([
            'agenda' => $request['agenda'],
            'catatan' => $request['catatan'],
            'created_by' => $created_by
        ]);

        return redirect()->route('presensi.index')
            ->with('success', 'Presensi pada agenda ' . $agenda_nama[0]['nama'] . ' (' . date('d-m-Y')  . ') telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function show(Presensi $presensi)
    {
        $agendas = Agenda::where('id', '=', $presensi->agenda)->first();
        $tanggal = (new Carbon($presensi->created_at))->isoFormat('dddd, D MMMM Y');
        return view('administrasi.presensi.show', compact('presensi', 'agendas', 'tanggal'));
    }

    /**
     * Fungsi tabel presensi -> agenda yang dijalankan.
     *
     * @return \Illuminate\Http\Response
     */
    public function log_presensi(Request $request, $presensi)
    {
        if ($request->ajax()) {
            $logpresensis = Logpresensi::with('user', 'presensi')
                ->where('presensi', '=', $presensi)
                ->get();

            return DataTables::of($logpresensis)
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Presensi $presensi)
    {
        $agendas = Agenda::orderBy('id')->get();
        $selectedAgenda = Presensi::select('agenda')
            ->where('agenda', '=', $presensi->agenda)->first();

        return view('administrasi.presensi.edit', compact('presensi', 'agendas', 'selectedAgenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presensi $presensi)
    {
        $request->validate([
            'agenda' => 'required|max:255',
            'catatan' => 'required',
            'old_agenda' => 'required|min:1'
        ]);

        $presensi->agenda = $request['agenda'];
        $presensi->catatan = $request['catatan'];
        $presensi->save();

        $old_agenda = Agenda::where('id', '=',  $request['old_agenda'])->first();
        $new_agenda = Agenda::where('id', '=',  $request['agenda'])->first();

        $tanggal = (new Carbon($presensi->created_at))->isoFormat('D MMMM Y');


        return redirect()->route('presensi.index')
            ->with('success', 'Data presensi pada agenda ' . $old_agenda->nama . ' (' . $tanggal .
                ') berhasil diubah menjadi agenda ' . $new_agenda->nama . ' (' . $tanggal . ')');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presensi = Presensi::with('agenda')->findOrFail($id);
        $agenda = Agenda::select('nama')->where('id', '=', $presensi->agenda)->first();
        //dd($agenda);
        $tanggal = (new Carbon($presensi->created_at))->format('d-m-Y');
        $presensi->delete();

        return redirect()->route('presensi.index')
            ->with('success', 'Data presensi pada agenda ' . $agenda->nama . ' ( ' . $tanggal . ' ) telah dihapus.');
    }
}
