<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBerkasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriBerkas = [
            [
                'nama' => 'Pas Foto',
                'folder_name' => 'pendaftaran/persyaratan',
                'accepted_file_types' => 'jpg/jpeg/png',
                'max_file_size' => 300,
                'is_multiple' => false,
                'key' => 'jalur_reguler',
                'disk' => 'local',
            ],
            [
                'nama' => 'Rapot',
                'folder_name' => 'pendaftaran/persyaratan',
                'accepted_file_types' => 'pdf',
                'max_file_size' => 3000,
                'is_multiple' => false,
                'key' => 'jalur_reguler',
                'disk' => 'local',
            ],
            [
                'nama' => 'Ijazah SMP/MTs',
                'folder_name' => 'pendaftaran/persyaratan',
                'accepted_file_types' => 'jpg/jpeg/png',
                'max_file_size' => 300,
                'is_multiple' => false,
                'key' => 'jalur_reguler',
                'disk' => 'local',
            ],
            [
                'nama' => 'Kartu Pelajar',
                'folder_name' => 'pendaftaran/persyaratan',
                'accepted_file_types' => 'jpg/jpeg/png',
                'max_file_size' => 300,
                'is_multiple' => false,
                'key' => 'jalur_reguler',
                'disk' => 'local',
            ]
        ];

        foreach ($kategoriBerkas as $item) {
            DB::table('kategori_berkas')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}
