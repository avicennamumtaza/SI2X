<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keluarga', function (Blueprint $table) {
            $table->string('nkk', 17)->primary();
            $table->string('nik_kepala_keluarga', 17)->index();
            // $table->integer('jumlah_nik');
            $table->string('no_rt', 2)->index();
            $table->string('nomor_telepon')->nullable();
            $table->timestamps();

            // Kunci asing
            $table->foreign('nkk')->references('nkk')->on('penduduk')->onDelete('cascade');
            $table->foreign('nik_kepala_keluarga')->references('nik')->on('penduduk')->onDelete('cascade');
            $table->foreign('no_rt')->references('no_rt')->on('rt')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga');
    }
};
