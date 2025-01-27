<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HubunganOrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hubungan_orang_tua')->insert([
            ['nama_hubungan' => 'Ayah'],
            ['nama_hubungan' => 'Ibu'],
            ['nama_hubungan' => 'Wali'],
        ]);
    }
}
