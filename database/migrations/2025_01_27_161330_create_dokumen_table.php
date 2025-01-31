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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->unsignedBigInteger('id_registrasi');
            $table->unsignedBigInteger('id_syarat');
            $table->string('nama_dokumen', 50);
            $table->string('data_dokumen', 50);
            $table->string('direktori_file', 255);
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamps();
            $table->foreign('id_registrasi')->references('id_registrasi')->on('data_registrasi');
            $table->foreign('id_syarat')->references('id_persyaratan')->on('persyaratan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
