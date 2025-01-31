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
        Schema::create('persyaratan', function (Blueprint $table) {
            $table->id('id_persyaratan');
            $table->unsignedBigInteger('id_jalur');
            $table->string('nama_persyaratan', 50);
            $table->text('deskripsi'); 
            $table->timestamps();

            $table->foreign('id_jalur')->references('id_jalur')->on('jalur_registrasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persyaratan');
    }
};
