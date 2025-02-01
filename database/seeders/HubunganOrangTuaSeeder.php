<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HubunganOrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = Carbon::now();

        $hubungan = [
            ['nama_hubungan' => 'Ibu'],
            ['nama_hubungan' => 'Ayah'],
            ['nama_hubungan' => 'Wali'],
        ];

        foreach ($hubungan as &$item) {
            $item['created_at'] = $timestamp;
            $item['updated_at'] = $timestamp;
            DB::table('hubungan_orang_tuas')->insert($item);
        }
    }
}
