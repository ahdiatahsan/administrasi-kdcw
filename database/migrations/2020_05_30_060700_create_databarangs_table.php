<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('databarangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('kondisi');
            $table->integer('jumlah');
            $table->integer('stok');
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
        Schema::dropIfExists('databarangs');
    }
}
