<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersyaratanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $persyaratan = [
            [
                'id_jalur' => 1,2,3,4,5,
                'nama_persyaratan' => 'Pas Foto',
                'deskripsi' => 'Pas Foto berwarna ukuran 3x4 cm Background Merah',
            ],
            [
                'id_jalur' => 1,2,3,4,5,
                'nama_persyaratan' => 'Rapot MTs/SMP',
                'deskripsi' => 'Rapot dari sekolah menengah pertama atau madrasah tsanawiyah',
            ],
            [
                'id_jalur' => 1,2,3,4,5,
                'nama_persyaratan' => 'NISN',
                'deskripsi' => 'NISN yang dapat dicek di https://nisn.data.kemdikbud.go.id/',
            ],
            [
                'id_jalur' => 1,2,3,4,5,
                'nama_persyaratan' => 'Kartu Keluarga',
                'deskripsi' => 'Kartu Keluarga yang diterbitkan oleh pemerintah Indonesia',
            ],
            [
                'id_jalur' => 1,2,3,4,5,
                'nama_persyaratan' => 'Akta Kelahiran',
                'deskripsi' => 'Akta Kelahiran resmi yang diterbitkan oleh Dinas Kependudukan dan Pencatatan Sipil',
            ],
            [
                'id_jalur' => 1,2,3,4,5,
                'nama_persyaratan' => 'Sertifikat Akreditasi',
                'deskripsi' => 'Sertifikat Akreditasi dari Sekolah Asal',
            ],
            [
                'id_jalur' => 2,
                'nama_persyaratan' => 'Piagam / Sertifikat',
                'deskripsi' => 'Piagam / Sertifikat yang discan',
            ],
            [
                'id_jalur' => 3,
                'nama_persyaratan' => 'KIP/ PKH/ KKS',
                'deskripsi' => 'KIP/ PKH/ KKS yang discan',
            ],
            
        ];

        foreach ($persyaratan as $item) {
            DB::table('persyaratan')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}
