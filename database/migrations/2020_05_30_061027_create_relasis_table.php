<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('alamat');
            $table->string('email');
            $table->string("kontak")->default('kosong');
            $table->string('logo')->nullable();
            $table->string('keterangan');
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
        Schema::dropIfExists('relasis');
    }
}
