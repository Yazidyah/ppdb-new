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
        Schema::create('biodata_wali', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_walilaki');
            $table->string('nik_walilaki')->unique();
            $table->string('pekerjaan_walilaki')->unique();
            $table->string('notelp_walilaki');
            $table->string('nama_waliperempuan');
            $table->string('nik_waliperempuan')->unique();
            $table->string('pekerjaan_waliperempuan')->unique();
            $table->string('notelp_waliperempuan');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata_wali');
    }
};
