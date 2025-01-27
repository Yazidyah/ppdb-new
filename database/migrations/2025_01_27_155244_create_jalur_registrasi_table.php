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
        Schema::create('jalur_registrasi', function (Blueprint $table) {
            $table->id('id_jalur');
            $table->string('nama_jalur', 50);
            $table->text('deskripsi');
            $table->date('tanggal_buka');
            $table->date('tanggal_tutup');
            $table->boolean('is_open')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jalur_registrasi');
    }
};