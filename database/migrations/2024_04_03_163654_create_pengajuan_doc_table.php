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
        Schema::create('pengajuan_doc', function (Blueprint $table) {
            //pake id karena tidak di rekomendasi tanpa id
            $table->increments('id');
            $table->string('nik', 16);
            $table->string('id_pengajuan');
            $table->timestamps();

            // $table->foreign('NIK')->references('NIK')->on('Penduduk')->onDelete('cascade');
            // $table->foreign('idPengaju')->references('idPengaju')->on('dokumen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_doc');
    }
};