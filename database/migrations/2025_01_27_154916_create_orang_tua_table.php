<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orang_tua', function (Blueprint $table) {
            $table->increments('id_orang_tua');
            $table->unsignedInteger('id_calon_siswa');
            $table->unsignedInteger('id_hubungan');
            $table->string('nama_lengkap', 100);
            $table->unsignedInteger('pekerjaan');
            $table->string('no_telp', 15);
            $table->timestamps();

            $table->foreign('id_calon_siswa')->references('id_calon_siswa')->on('calon_siswa')->onDelete('cascade');
            $table->foreign('id_hubungan')->references('id_hubungan')->on('hubungan_orang_tua')->onDelete('cascade');
            $table->foreign('pekerjaan')->references('id_pekerjaan')->on('pekerjaan_orang_tua')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orang_tua');
    }
};