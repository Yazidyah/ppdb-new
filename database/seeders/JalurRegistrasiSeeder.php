<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class JalurRegistrasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now();

        $jalur = [
            [
                'nama_jalur' => 'Reguler',
                'deskripsi' => 'Jalur reguler untuk pendaftaran umum',
                'tanggal_buka' => '2026-05-04',
                'tanggal_tutup' => '2026-06-04',
                'is_open' => true,
            ],
            [
                'nama_jalur' => 'Prestasi',
                'deskripsi' => 'Jalur afirmasi untuk siswa berprestasi',
                'tanggal_buka' => '2026-05-04',
                'tanggal_tutup' => '2026-05-07',
                'is_open' => false,
            ],
            [
                'nama_jalur' => 'Afirmasi KETM',
                'deskripsi' => 'Jalur afirmasi untuk siswa dari keluarga ekonomi tidak mampu',
                'tanggal_buka' => '2026-05-04',
                'tanggal_tutup' => '2026-05-07',
                'is_open' => false,
            ],
            [
                'nama_jalur' => 'Afirmasi ABK',
                'deskripsi' => 'Jalur afirmasi untuk siswa berkebutuhan khusus',
                'tanggal_buka' => '2026-05-04',
                'tanggal_tutup' => '2026-05-07',
                'is_open' => false,
            ],
            [
                'nama_jalur' => 'Afirmasi Kepemimpinan',
                'deskripsi' => 'Jalur Kepemimpinan',
                'tanggal_buka' => '2026-05-04',
                'tanggal_tutup' => '2026-05-07',
                'is_open' => false,
            ],
        ];

        foreach ($jalur as &$item) {
            $item['created_at'] = $timestamp;
            $item['updated_at'] = $timestamp;
            DB::table('jalur_registrasi')->insert($item);
        }
    }
}
