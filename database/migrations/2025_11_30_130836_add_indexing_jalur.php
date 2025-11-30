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
        Schema::table('jalur_registrasi', function (Blueprint $table) {
            $table->index('nama_jalur');
            $table->index('is_open');
            $table->index('tanggal_buka');
            $table->index('tanggal_tutup');
        });
    }

    public function down(): void
    {
        Schema::table('jalur_registrasi', function (Blueprint $table) {
            $table->dropIndex(['nama_jalur']);
            $table->dropIndex(['is_open']);
            $table->dropIndex(['tanggal_buka']);
            $table->dropIndex(['tanggal_tutup']);
        });
    }
};
