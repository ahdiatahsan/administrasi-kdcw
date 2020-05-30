<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('jabatan')->unsigned();
            $table->string('kontak');
            $table->string('noreg');
            $table->string('status_surat')->nullable();
            $table->string('foto')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('jabatan')->references('id')->on('jabatans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
