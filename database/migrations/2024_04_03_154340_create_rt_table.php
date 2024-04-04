<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rt', function (Blueprint $table) {
            $table->id('no_rt');
            $table->string('nik_rt',16);
            $table->integer('jumlah_keluarga_rt');
            $table->integer('jumlah_penduduk_rt');
            $table->timestamps();

            $table->foreign('nik_rt')->references('nik')->on('penduduk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rt');
    }
}