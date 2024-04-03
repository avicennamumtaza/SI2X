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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id('id_pengumuman');
            //apakah perlu no rw
             //$table->string('noRW',4);
            $table->string('judul', 50);
            $table->text('deskripsi');
            $table->date('tanggal_pengumuman');
            $table->timestamps();

             //$table->foreign('noRW')->references('noRW')->on('RW')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};