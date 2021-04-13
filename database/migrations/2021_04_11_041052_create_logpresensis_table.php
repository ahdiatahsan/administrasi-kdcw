<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogpresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logpresensis', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('user')->unsigned();
            $table->integer('presensi')->unsigned();
            $table->timestamps();
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('presensi')->references('id')->on('presensis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logpresensis');
    }
}
