<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PekerjaanOrangTua;

class PekerjaanOrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pekerjaan = [
            ['nama_pekerjaan' => 'Ibu Rumah Tangga'],
            ['nama_pekerjaan' => 'Petani'],
            ['nama_pekerjaan' => 'Nelayan'],
            ['nama_pekerjaan' => 'Guru'],
            ['nama_pekerjaan' => 'Dokter'],
            ['nama_pekerjaan' => 'Polisi'],
            ['nama_pekerjaan' => 'Tentara'],
            ['nama_pekerjaan' => 'Pegawai Negeri'],
            ['nama_pekerjaan' => 'Wiraswasta'],
            ['nama_pekerjaan' => 'Karyawan'],
            ['nama_pekerjaan' => 'Buruh'],
            ['nama_pekerjaan' => 'Sopir'],
        ];

        foreach ($pekerjaan as $item) {
            PekerjaanOrangTua::firstOrCreate(
                ['nama_pekerjaan' => $item['nama_pekerjaan']],
                $item
            );
        }
    }
}
