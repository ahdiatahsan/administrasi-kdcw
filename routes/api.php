<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/* Presensi */

Route::prefix('presensi')->group(function () {
    Route::post('login', 'Api\PresensiAPIController@login');
    Route::post('presensi', 'Api\PresensiAPIController@presensi_store');
    Route::post('logpresensi', 'Api\PresensiAPIController@logpresensi_store');
    Route::get('agendas', 'Api\PresensiAPIController@agenda_show');
    Route::get('presensis', 'Api\PresensiAPIController@presensi_show');
    Route::get('ceknoreg/{noreg}', 'Api\PresensiAPIController@check_noreg');
});
