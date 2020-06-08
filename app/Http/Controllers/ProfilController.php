<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function ViewProfil()
    {
        return view('profil.profil');
    }

    public function ViewPassword()
    {
        return view('profil.password');
    }
}
