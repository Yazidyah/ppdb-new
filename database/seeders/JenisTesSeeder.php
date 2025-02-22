<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        foreach ($data as &$item) {
            $item['created_at'] = Carbon::now();
            $item['updated_at'] = Carbon::now();
        }

        DB::table('jenis_tes')->insert($data);
    }
}
