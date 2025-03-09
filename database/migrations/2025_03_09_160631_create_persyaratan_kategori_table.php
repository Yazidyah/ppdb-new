<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kategori_persyaratan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_persyaratan');
            $table->unsignedBigInteger('id_kategori_berkas');
            $table->foreign('id_persyaratan')->references('id_persyaratan')->on('persyaratan')->onDelete('cascade');
            $table->foreign('id_kategori_berkas')->references('id')->on('kategori_berkas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_persyaratan');
    }
};
