<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('profil')->except('index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profil.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profil.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profil = User::find($id);
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $old_password = $request['old_password'];
        $new_password = bcrypt($request['password']);

        $check_password = Hash::check($old_password, Auth::user()->password, []);

        if ($check_password) {
            $profil->password = $new_password;
            $profil->save();
        }
        else {
            return redirect()->route('profil.edit', $profil->id)
            ->with('not_match', 'Maaf password lama Anda tidak sesuai dengan yang Anda masukkan, coba lagi.');
        }
        
        return redirect()->route('profil.edit', $profil->id)->with('success', 'Password Anda telah diubah.');
    }
}
