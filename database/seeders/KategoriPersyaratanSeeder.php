<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        ];

        DB::table('kategori_persyaratan')->insert($kategoriPersyaratan);
    }
}
