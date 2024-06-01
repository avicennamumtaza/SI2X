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
        Schema::create('alternatif', function (Blueprint $table) {
            // $table->id('nkk');
            $table->string('nkk')->primary()->index();
            $table->bigInteger('penghasilan');
            $table->integer('tanggungan');
            $table->bigInteger('pajak_bumibangunan');
            $table->bigInteger('pajak_kendaraan');
            // $table->integer('daya_listrik');
            $table->integer('daya_listrik');
            $table->timestamps();
            
            $table->foreign('nkk')->references('nkk')->on('keluarga')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternatif');
    }
};
