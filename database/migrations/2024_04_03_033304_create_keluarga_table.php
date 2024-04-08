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
            $table->string('nkk', 17)->primary()->index();
            $table->string('nik_kepala_keluarga', 17)->index();
            $table->integer('jumlah_nik');
            $table->timestamps();

            // Indeks untuk kunci asing
            // $table->index('nkk');
            // $table->index('nik_kepala_keluarga');

            // Kunci asing
            $table->foreign('nkk')->references('nkk')->on('penduduk')->onDelete('cascade');
            $table->foreign('nik_kepala_keluarga')->references('nik')->on('penduduk')->onDelete('cascade');
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