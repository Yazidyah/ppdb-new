<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('calon_siswa', function (Blueprint $table) {
            $table->id('id_calon_siswa');
            $table->unsignedBigInteger('id_user')->unique();
            $table->string('nama_lengkap', 50)->nullable();
            $table->integer('NIK')->unique()->nullable();
            $table->integer('NISN')->unique()->nullable();
            $table->string('no_telp', 15)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('tanggal_lahir')->nullable()->nullable();
            $table->string('NPSN', 15)->nullable();
            $table->string('sekolah_asal', 100)->nullable();
            $table->text('alamat_domisili')->nullable();
            $table->text('alamat_kk')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Menambahkan foreign key constraint
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_siswa');
    }
};
