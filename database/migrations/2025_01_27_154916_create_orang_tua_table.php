<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orang_tua', function (Blueprint $table) {
            $table->id('id_orang_tua');
            $table->unsignedBigInteger('id_calon_siswa');
            $table->unsignedBigInteger('id_hubungan');
            $table->string('nama_lengkap', 100);
            $table->string('nik', 20);
            $table->unsignedBigInteger('pekerjaan');
            $table->string('no_telp', 15);
            $table->timestamps();

            $table->foreign('id_calon_siswa')->references('id_calon_siswa')->on('calon_siswa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orang_tua');
    }
};