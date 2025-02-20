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
        schema::dropIfExists('data_berkas');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('data_berkas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_berkas')->nullable();
            $table->string('data_berkas')->nullable();
            $table->timestamps();
        });
    }
};
