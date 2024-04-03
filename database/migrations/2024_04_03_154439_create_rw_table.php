<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRwTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rw', function (Blueprint $table) {
            $table->id('no_rw');
            $table->string('nik_rw',16);
            $table->integer('jumlah_rt');
            $table->integer('jumlah_keluarga_rw');
            $table->integer('jumlah_penduduk_rw');
            $table->timestamps();

            // $table->foreign('nikRW')->references('NIK')->on('penduduk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rw');
    }
}