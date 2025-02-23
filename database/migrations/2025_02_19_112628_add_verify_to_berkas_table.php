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
        Schema::table('berkas', function (Blueprint $table) {
            //
            $table->integer('verify')->nullable();
            $table->text('verify_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berkas', function (Blueprint $table) {
            $table->dropColumn('verify');
            $table->dropColumn('verify_notes');
        });
    }
};
