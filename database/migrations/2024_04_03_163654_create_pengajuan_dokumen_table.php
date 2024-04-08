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
        Schema::create('pengajuan_dokumen', function (Blueprint $table) {
            //pake id karena tidak direkomendasikan tanpa id
            $table->id('id_pengajuandokumen');
            $table->string('no_rt')->index();
            $table->unsignedBigInteger('id_dokumen')->index();
            $table->string('nik_pengaju', 17)->index();
            $table->string('nama_pengaju', 50);
            $table->string('status_pengajuan', 10);
            $table->text('catatan');
            $table->timestamps();

            $table->foreign('no_rt')->references('no_rt')->on('rt')->onDelete('cascade');
            $table->foreign('id_dokumen')->references('id_dokumen')->on('dokumen')->onDelete('cascade');
            $table->foreign('nik_pengaju')->references('nik')->on('penduduk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_dokumen');
    }
};
