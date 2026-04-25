<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisTes;

class JenisTesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'no_jalur' => '1',
                'nama' => 'Tes BQ Reguler',
            ],
            [
                'no_jalur' => '2',
                'nama' => 'Tes BQ Afirmatif dan Wawancara',
            ],
            [
                'no_jalur' => '2',
                'nama' => 'Tes Japres',
            ],
            [
                'no_jalur' => '1',
                'nama' => 'Tes Akademik',
            ],
        ];

        foreach ($data as $item) {
            JenisTes::firstOrCreate(
                ['no_jalur' => $item['no_jalur'], 'nama' => $item['nama']],
                $item
            );
        }
    }
}
