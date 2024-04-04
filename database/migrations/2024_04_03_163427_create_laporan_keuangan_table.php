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
        Schema::create('laporan_keuangan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->String('no_rw', 4)->index();
            $table->float('nominal');
            $table->text('detail_laporan');
            $table->date('tanggal_laporan');
            $table->string('pihak_terlibat',50);
            $table->float('saldo');
            $table->boolean('is_income');
            $table->timestamps();

            $table->foreign('no_rw')->references('no_rw')->on('rw')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keuangan');
    }
};
