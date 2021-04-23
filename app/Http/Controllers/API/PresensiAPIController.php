<?php

namespace App\Http\Controllers\API;

use App\Agenda;
use App\Http\Controllers\Controller;
use App\Logpresensi;
use App\Presensi;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PresensiAPIController extends Controller
{

    //login
    public function login(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'jabatan' => 8])) {
            $user = $user->find(Auth::user()->id);

            return $user;
        }

        return response()->json([
            'message' => 'Kredensial Tidak Ditemukan', 404
        ]);
    }

    //populate option select
    public function agenda_show()
    {
        $agendas = Agenda::orderBy('id')->get();

        return $agendas;
    }

    //show all presensi that has been created
    public function presensi_show()
    {
        $presensis = Presensi::with('agenda')->orderBy('id', 'ASC')->get();

        return $presensis;
    }

    //check if user with noreg exist
    public function check_noreg($noreg)
    {
        try {
            $user = User::select('id')->where('noreg', '=', $noreg)->firstorFail();
        } catch (ModelNotFoundException $err) {
            return response()->json('Data Anggota Tidak Ditemukan', 404);
        }

        return $user;
    }

    //store presensi resource
    public function presensi_store(Request $request)
    {
        $request->validate([
            'agenda' => 'required|numeric',
            'catatan' => 'required|string',
            'created_by' => 'required|numeric',
        ]);

        try {
            Agenda::where('id', '=', $request->agenda)->firstorFail();
        } catch (ModelNotFoundException $err) {
            return response()->json('Data Agenda Tidak Ditemukan', 404);
        }

        Presensi::create([
            'agenda' => $request['agenda'],
            'catatan' => $request['catatan'],
            'created_by' => $request['created_by']
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Data Presensi Berhasil Disimpan'
        ]);
    }

    //store presensi resource
    public function logpresensi_store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required|numeric',
            'id_presensi' => 'required|numeric',
        ]);

        Logpresensi::create([
            'user' => $request['id_anggota'],
            'presensi' => $request['id_presensi']
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Data Log Presensi Berhasil Disimpan'
        ]);
    }
}
