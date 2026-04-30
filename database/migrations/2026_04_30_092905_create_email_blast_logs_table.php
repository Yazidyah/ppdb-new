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
        Schema::create('email_blast_logs', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id')->index();
            $table->string('jalur_type');
            $table->unsignedBigInteger('siswa_id');
            $table->string('email');
            $table->integer('status');
            $table->enum('sent_status', ['pending', 'sent', 'failed'])->default('pending');
            $table->text('error_message')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
            
            $table->index(['batch_id', 'sent_status']);
            $table->index(['siswa_id', 'batch_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_blast_logs');
    }
};
