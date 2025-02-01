<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hubungan_orang_tua', function (Blueprint $table) {
            $table->id('id_hubungan');
            $table->string('nama_hubungan', 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hubungan_orang_tua');
    }
};