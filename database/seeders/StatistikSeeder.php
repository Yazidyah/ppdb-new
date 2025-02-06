<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistik;

class StatistikSeeder extends Seeder
{
    public function run()
    {
        $statistikData = [
            ['nama_statistik' => 'Total Pendaftar', 'count' => 0],
            ['nama_statistik' => 'Pendaftar Jalur Reguler', 'count' => 0],
            ['nama_statistik' => 'Pendaftar Jalur Afirmasi Prestasi', 'count' => 0],
            ['nama_statistik' => 'Pendaftar Jalur Afirmasi KETM', 'count' => 0],
            ['nama_statistik' => 'Pendaftar Jalur Afirmasi ABK', 'count' => 0],
            ['nama_statistik' => 'Laki-laki', 'count' => 0],
            ['nama_statistik' => 'Perempuan', 'count' => 0],
            ['nama_statistik' => 'Sekolah Negeri', 'count' => 0],
            ['nama_statistik' => 'Sekolah Swasta', 'count' => 0],
            ['nama_statistik' => 'Diluar Kota', 'count' => 0],
            ['nama_statistik' => 'Dalam Kota', 'count' => 0],
        ];
        foreach ($statistikData as $data) {
            $data['updated_at'] = now();
            Statistik::create($data);
        }
    }
}
