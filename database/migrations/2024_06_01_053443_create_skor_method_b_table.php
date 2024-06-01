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
        Schema::create('skor_method_b', function (Blueprint $table) {
            $table->string('nkk')->primary()->index();
            $table->timestamps();
            
            $table->foreign('nkk')->references('nkk')->on('alternatif')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skor_method_b');
    }
};
