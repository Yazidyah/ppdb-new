<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriPersyaratan;

class KategoriPersyaratanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriPersyaratan = [
            [
                'id_persyaratan' => 1,
                'id_kategori_berkas' => 1,
            ],
            [
                'id_persyaratan' => 2,
                'id_kategori_berkas' => 2,
            ],
            [
                'id_persyaratan' => 3,
                'id_kategori_berkas' => 3,
            ],
            [
                'id_persyaratan' => 4,
                'id_kategori_berkas' => 4,
            ],
            [
                'id_persyaratan' => 5,
                'id_kategori_berkas' => 5,
            ],
            [
                'id_persyaratan' => 6,
                'id_kategori_berkas' => 6,
            ]
        ];

        foreach ($kategoriPersyaratan as $record) {
            KategoriPersyaratan::firstOrCreate([
                'id_persyaratan' => $record['id_persyaratan'],
                'id_kategori_berkas' => $record['id_kategori_berkas'],
            ]);
        }
    }
}
