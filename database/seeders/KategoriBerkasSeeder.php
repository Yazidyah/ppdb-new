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
                'max_file_size' => 30000,
                'is_multiple' => false,
                'key' => 'jalur_reguler',
                'disk' => 'local',
                'created_at' => '2024-12-02 19:30:40',
                'updated_at' => '2024-12-02 19:30:42',
            ],
            [
                'nama' => 'Ijazah SMP/MTs',
                'folder_name' => 'pendaftaran/persyaratan',
                'accepted_file_types' => 'pdf',
                'max_file_size' => 30000,
                'is_multiple' => false,
                'key' => 'jalur_reguler',
                'disk' => 'local',
                'created_at' => '2024-12-02 19:30:40',
                'updated_at' => '2024-12-02 19:30:42',
            ],
            [
                'nama' => 'Kartu Pelajar',
                'folder_name' => 'pendaftaran/persyaratan',
                'accepted_file_types' => 'pdf',
                'max_file_size' => 30000,
                'is_multiple' => false,
                'key' => 'jalur_reguler',
                'disk' => 'local',
                'created_at' => '2024-12-02 19:30:40',
                'updated_at' => '2024-12-02 19:30:42',
            ],
        ];

        foreach ($kategoriBerkas as $kategori) {
            KategoriBerkas::create($kategori);
        }
    }
}
