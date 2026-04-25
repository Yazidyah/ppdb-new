<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HubunganOrangTua;

class HubunganOrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hubungan = [
            ['nama_hubungan' => 'Ibu'],
            ['nama_hubungan' => 'Ayah'],
            ['nama_hubungan' => 'Wali'],
        ];

        foreach ($hubungan as $item) {
            HubunganOrangTua::firstOrCreate(
                ['nama_hubungan' => $item['nama_hubungan']],
                $item
            );
        }
    }
}
