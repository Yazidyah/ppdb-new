<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistik;

class StatistikSeeder extends Seeder
{
    public function run()
    {
        $statistikData = [
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
