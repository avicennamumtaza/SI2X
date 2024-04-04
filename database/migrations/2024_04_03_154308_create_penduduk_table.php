<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->string('nik', 16)->primary();
            $table->string('nkk', 16)->index();
            $table->string('no_rt', 4);
            $table->string('nama', 50);
            $table->string('tempat_lahir', 25);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('jenis_kelamin');
            $table->string('pekerjaan', 30);
            $table->string('gol_darah', 5);
            $table->boolean('is_married');
            $table->boolean('is_stranger');
            $table->timestamps();


            $table->foreign('nkk')->references('nkk')->on('keluarga')->onDelete('cascade');
            // $table->foreign('noRT')->references('noRT')->on('rt')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penduduk');
    }
}
