<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//konfigurasi autentikasi
Auth::routes(['register' => false, 'verify' => false]);

//dashboard
Route::get('/home', 'HomeController@index')->name('home');

//profil
Route::get('/profil', 'ProfilController@ViewProfil')->name('profil');
Route::get('/profil_pass', 'ProfilController@ViewPassword')->name('profil_pass');


//botman

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');
