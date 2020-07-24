<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_barang');
            $table->string('peminjam');
            $table->integer('jumlah');
            $table->datetime('tanggal_dipinjam');
            $table->datetime('tanggal_kembali');
            $table->string('keterangan');
            $table->string('diterima_oleh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekapans');
    }
}
