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
                'nama' => 'Foto Kegiatan',
                'folder_name' => 'public/kegiatan',
                'accepted_file_types' => 'jpg',
                'max_file_size' => 30000,
                'is_multiple' => false,
                'key' => 'foto_kegiatan',
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
