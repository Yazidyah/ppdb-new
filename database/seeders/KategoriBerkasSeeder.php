<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriBerkas;

class KategoriBerkasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriBerkas = [

            [
                'nama' => 'Rapot',
                'folder_name' => 'pendaftaran/persyaratan',
                'accepted_file_types' => 'pdf',
                'max_file_size' => 300,
                'is_multiple' => false,
                'key' => 'jalur_reguler',
                'disk' => 'local',
            ],
            [
                'nama' => 'Ijazah SMP/MTs',
                'folder_name' => 'pendaftaran/persyaratan',
                'accepted_file_types' => 'pdf',
                'max_file_size' => 300,
                'is_multiple' => false,
                'key' => 'jalur_reguler',
                'disk' => 'local',
            ],
            [
                'nama' => 'Kartu Pelajar',
                'folder_name' => 'pendaftaran/persyaratan',
                'accepted_file_types' => 'pdf',
                'max_file_size' => 300,
                'is_multiple' => false,
                'key' => 'jalur_reguler',
                'disk' => 'local',
            ],
        ];

        foreach ($kategoriBerkas as &$kategori) {
            $kategori['created_at'] = now();
            $kategori['updated_at'] = now();
        }

        foreach ($kategoriBerkas as $kategori) {
            KategoriBerkas::create($kategori);
        }
    }
}
