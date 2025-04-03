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
                'tanggal_buka' => '2025-01-01',
                'tanggal_tutup' => '2025-01-31',
                'is_open' => true,
            ],
            [
                'nama_jalur' => 'Afirmasi Prestasi',
                'deskripsi' => 'Jalur afirmasi untuk siswa berprestasi',
                'tanggal_buka' => '2025-02-01',
                'tanggal_tutup' => '2025-02-28',
                'is_open' => false,
            ],
            [
                'nama_jalur' => 'Afirmasi KETM',
                'deskripsi' => 'Jalur afirmasi untuk siswa dari keluarga ekonomi tidak mampu',
                'tanggal_buka' => '2025-03-01',
                'tanggal_tutup' => '2025-03-31',
                'is_open' => false,
            ],
            [
                'nama_jalur' => 'Afirmasi ABK',
                'deskripsi' => 'Jalur afirmasi untuk siswa berkebutuhan khusus',
                'tanggal_buka' => '2025-04-01',
                'tanggal_tutup' => '2025-04-30',
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
