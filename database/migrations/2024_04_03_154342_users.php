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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nik', 17)->index();
            $table->string('username', 20);
            // $table->string('role', 20);
            ;$table->enum('role', ['Rt', 'Rw']);
            ;$table->text('foto_profil')->nullable();
            $table->string('email', 50);
            $table->text('password');
            $table->timestamps();

            $table->foreign('nik')->references('nik')->on('penduduk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
