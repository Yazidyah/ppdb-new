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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kategori_berkas_id')->nullable();
            $table->integer('id_syarat')->default(0)->nullable();
            $table->string('original_name');
            $table->string('file_name');
            $table->uuid('document_uuid')->nullable();
            $table->morphs('berkasable');
            $table->foreignId('uploader_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
            $table->string('disk')->nullable()->default('local');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
