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
        Schema::create('data_registrasi', function (Blueprint $table) {
            $table->id("id_registrasi");
            $table->unsignedBigInteger('id_calon_siswa');
            $table->unsignedBigInteger('id_jalur')->nullable();
            $table->string('kode_registrasi')->nullable();
            $table->string('status', 20)->default('0')->nullable();
            $table->timestamps(); // created_at and updated_at
            $table->softDeletes(); // deleted_at
            $table->foreign('id_calon_siswa')->references('id_calon_siswa')->on('calon_siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_registrasi');
    }
};
