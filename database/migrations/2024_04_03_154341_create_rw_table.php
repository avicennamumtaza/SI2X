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
            $table->string('no_rw')->primary();
            $table->string('nik_rw', 17)->index();
            $table->integer('jumlah_rt');
            $table->integer('jumlah_keluarga_rw');
            $table->integer('jumlah_penduduk_rw');
            $table->timestamps();

            $table->foreign('nik_rw')->references('nik')->on('penduduk')->onDelete('cascade');
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
