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
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->string('status_sekolah')->nullable()->after('sekolah_asal');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->dropColumn('status_sekolah');
        });
    }
};
