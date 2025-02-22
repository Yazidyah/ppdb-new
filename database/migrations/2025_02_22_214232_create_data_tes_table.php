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
        Schema::create('data_tes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_registrasi');
            $table->unsignedBigInteger('id_jadwal_tes');
            $table->timestamps();

            $table->foreign('id_registrasi')->references('id_registrasi')->on('data_registrasi')->onDelete('cascade');
            $table->foreign('id_jadwal_tes')->references('id')->on('jadwal_tes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_tes');
    }
};
