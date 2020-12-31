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
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/', 'HomeController@index')->name('home');

//adminstrasi
Route::prefix('administrasi')->group(function () {
    Route::resource('jabatan', 'JabatanController'); //jabatan
    Route::resource('anggota', 'UserController', ['parameters' => ['anggota' => 'user']]); //anggota-users
    Route::resource('persuratan', 'PersuratanController'); //persuratan
    // API data administrasi dalam datatable --> tetap harus auth
    Route::get('table_surat_masuk', 'PersuratanController@surat_masuk')->name('surat_masuk');
    Route::get('table_surat_keluar', 'PersuratanController@surat_keluar')->name('surat_keluar');
});

//inventaris
Route::prefix('inventaris')->group(function () {
    Route::resource('barang', 'DatabarangController'); //data-barang
    Route::resource('peminjaman', 'PeminjamanController'); //peminjaman
    Route::get('/kembalikan/{peminjaman}/barang', 'PeminjamanController@kembalikan_view')->name('kembalikan.view'); //rekap
    Route::post('/kembalikan/{peminjaman}', 'PeminjamanController@kembalikan_store')->name('kembalikan.store'); //rekap
    Route::get('/rekapan-peminjaman', 'PeminjamanController@rekap')->name('rekap_peminjaman'); //rekap
});

//keuangan
Route::resource('keuangan', 'KeuanganController');

//relasi
Route::resource('relasi', 'RelasiController');

//profil
Route::resource('profil', 'ProfilController');
Route::patch('/profil/ubah/{id}', 'ProfilController@ubah')->name('profil.ubah'); //ubah informasi pribadi

//botman
Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');
