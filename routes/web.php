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

//adminstrasi
Route::prefix('admininstrasi')->group(function () {
    Route::resource('jabatan', 'JabatanController'); //jabatan
    Route::resource('anggota', 'UserController', ['parameters' => ['anggota' => 'user']]); //anggota-users
});

//dashboard
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

//relasi
Route::resource('relasi', 'RelasiController');

//keuangan
Route::resource('keuangan', 'KeuanganController');

//profil
Route::get('/profil/password', 'ProfilController@password')->name('profil_pass');
Route::resource('profil', 'ProfilController');

//botman
Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');
