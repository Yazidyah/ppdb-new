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
            $table->bigIncrements('id_kategori');
            $table->string('name', 255)->nullable();
            $table->string('accepted_file_types', 255)->nullable();
            $table->integer('max_file_size')->nullable();
            $table->boolean('is_multiple')->nullable();
            $table->string('key', 255)->nullable();
            $table->string('disk', 255)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
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
