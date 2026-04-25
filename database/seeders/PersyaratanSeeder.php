<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persyaratan;

class PersyaratanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $persyaratan = [
            [
                'id_jalur' => 1,
                'nama_persyaratan' => 'Pas Foto',
                'deskripsi' => 'Pas Foto berwarna ukuran 3x4 cm Background Merah',
            ],
            [
                'id_jalur' => 1,
                'nama_persyaratan' => 'Rapot MTs/SMP',
                'deskripsi' => 'Rapot dari sekolah menengah pertama atau madrasah tsanawiyah',
            ],
            [
                'id_jalur' => 1,
                'nama_persyaratan' => 'NISN',
                'deskripsi' => 'NISN yang dapat dicek di https://nisn.data.kemdikbud.go.id/',
            ],
            [
                'id_jalur' => 1,
                'nama_persyaratan' => 'Kartu Keluarga',
                'deskripsi' => 'Kartu Keluarga yang diterbitkan oleh pemerintah Indonesia',
            ],
            [
                'id_jalur' => 1,
                'nama_persyaratan' => 'Akta Kelahiran',
                'deskripsi' => 'Akta Kelahiran resmi yang diterbitkan oleh Dinas Kependudukan dan Pencatatan Sipil',
            ],
            [
                'id_jalur' => 1,
                'nama_persyaratan' => 'Sertifikat Akreditasi',
                'deskripsi' => 'Sertifikat Akreditasi dari Sekolah Asal',
            ]
        ];

        foreach ($persyaratan as $item) {
            Persyaratan::firstOrCreate(
                ['id_jalur' => $item['id_jalur'], 'nama_persyaratan' => $item['nama_persyaratan']],
                $item
            );
        }
    }
}
