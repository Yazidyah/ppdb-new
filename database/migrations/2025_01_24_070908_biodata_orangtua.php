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
        Schema::create('biodata_orangtua', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_ayah');
            $table->string('nik_ayah')->unique();
            $table->string('pekerjaan_ayah')->unique();
            $table->string('notelp_ayah');
            $table->string('nama_ibu');
            $table->string('nik_ibu')->unique();
            $table->string('pekerjaan_ibu')->unique();
            $table->string('notelp_ibu');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata_orangtua');
    }
};
