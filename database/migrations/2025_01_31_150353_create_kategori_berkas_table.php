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
        Schema::create('kategori_berkas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('folder_name');
            $table->string('accepted_file_types');
            $table->integer('max_file_size');
            $table->boolean('is_multiple')->default(0);
            $table->string('key')->nullable();
            $table->string('disk')->nullable()->default('local');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_berkas');
    }
};
