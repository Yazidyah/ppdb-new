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
            ['nama_statistik' => 'Pendaftar Laki-laki', 'count' => 0],
            ['nama_statistik' => 'Pendaftar Perempuan', 'count' => 0],
            ['nama_statistik' => 'Dari Sekolah Negeri', 'count' => 0],
            ['nama_statistik' => 'Dari Sekolah Swasta', 'count' => 0],
            ['nama_statistik' => 'Dari Luar Kota', 'count' => 0],
            ['nama_statistik' => 'Dari Dalam Kota', 'count' => 0],
            ['nama_statistik' => 'Pendaftar Lulus', 'count' => 0],
            ['nama_statistik' => 'Pendaftar Tidak Lulus', 'count' => 0],
        ];
        foreach ($statistikData as $data) {
            $data['updated_at'] = now();
            Statistik::create($data);
        }
    }
}
