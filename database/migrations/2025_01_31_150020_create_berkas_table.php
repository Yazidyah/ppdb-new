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
            $table->id('id_berkas');
            $table->integer('kategori_berkas_id');
            $table->integer('id_syarat')->default(0)->nullable();
            $table->string('original_name', 255)->nullable();
            $table->string('file_name', 255)->nullable();
            $table->uuid('document_uuid')->nullable();
            $table->string('berkasable_type', 255)->nullable();
            $table->bigInteger('berkasable_id')->nullable();
            $table->bigInteger('uploader_id')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
            $table->string('disk', 255);
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
