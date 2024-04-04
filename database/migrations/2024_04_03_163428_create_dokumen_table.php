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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->string('no_rt',4);
            $table->string('nik_pengaju',16);
            $table->string('jenis_dokumen',16);
            $table->string('status_pengajuan',10);
            $table->text('catatan');
            $table->string('nama_pengaju',50);
            $table->date('tanggal_pengajuan');
            $table->timestamps();

            // $table->foreign('noRT')->references('noRT')->on('RT')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};