<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('npsn', 8)->nullable()->unique();
            $table->string('sekolah_asal', 100)->nullable();
            $table->string('status_sekolah')->nullable();
            $table->string('predikat_akreditasi_sekolah', 100)->nullable();
            $table->string('bentuk_sekolah', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_sekolah');
    }
};
