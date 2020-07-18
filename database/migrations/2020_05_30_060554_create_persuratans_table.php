<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersuratansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persuratans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_surat');
            $table->string('judul');
            $table->string('dari_kepada');
            $table->date('tanggal');
            $table->enum('jenis_surat', ['Surat Masuk', 'Surat Keluar']);
            $table->string('foto')->nullable();
            $table->integer('created_by')->unsigned();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persuratans');
    }
}
