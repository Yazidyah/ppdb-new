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
        Schema::create('rapot', function (Blueprint $table) {
            $table->id('id_rapot');
            $table->unsignedBigInteger('id_registrasi');
            $table->json('nilai_rapot')->nullable();
            $table->timestamps();

            $table->foreign('id_registrasi')->references('id_registrasi')->on('data_registrasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapot');
    }
};
