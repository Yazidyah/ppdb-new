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
        Schema::table('data_registrasi', function (Blueprint $table) {
            $table->string('id_tes')->after('id_jalur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_registrasi', function (Blueprint $table) {
            $table->dropColumn('id_tes');
        });
    }
};
