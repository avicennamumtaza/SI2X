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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id('id_umkm');
            // $table->string('no_rw', 4)->index();
            $table->string('nik_pemilik', 17)->index();
            $table->string('nama_umkm', 50);
            $table->string('wa_umkm', 14);
            // ;$table->text('alamat_umkm');
            $table->text('foto_umkm');
            // $table->text('desc_umkm');
            ;$table->text('deskripsi_umkm');
            // $table->string('status_umkm', 10);
            ;$table->enum('status_umkm', ['Baru', 'Disetujui', 'Ditolak']);
            $table->timestamps();

            $table->foreign('nik_pemilik')->references('nik')->on('penduduk')->onDelete('cascade');
            // $table->foreign('no_rw')->references('no_rw')->on('rw')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
