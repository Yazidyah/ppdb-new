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
        DB::table('persyaratan')->insert([
            [
                'id_jalur' => 1, 
                'nama_persyaratan' => 'Ijazah SMP/MTs',
                'deskripsi' => 'Ijazah dari sekolah menengah pertama atau madrasah tsanawiyah'
            ],
            [
                'id_jalur' => 1, 
                'nama_persyaratan' => 'Rapot',
                'deskripsi' => 'Rapot dari sekolah menengah pertama atau madrasah tsanawiyah'
            ]
        ]);
    }
}
