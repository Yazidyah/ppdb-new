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
            $table->boolean('is_active')->default(true)->after('status');
            $table->index(['id_calon_siswa', 'is_active'], 'data_registrasi_calon_siswa_active_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_registrasi', function (Blueprint $table) {
            $table->dropIndex('data_registrasi_calon_siswa_active_idx');
            $table->dropColumn('is_active');
        });
    }
};



