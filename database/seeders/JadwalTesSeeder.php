<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JadwalTes;

class JadwalTesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Data asli
            [
                'id_jenis_tes' => 1,
                'ruang' => 'A',
                'tanggal' => '2025-02-24 00:00:00.000',
                'jam_mulai' => '09:30:00',
                'jam_selesai' => '10:30:00',
                'terisi' => 0,
                'kuota' => 25,
            ],
            [
                'id_jenis_tes' => 2,
                'ruang' => 'A',
                'tanggal' => '2025-02-24 00:00:00.000',
                'jam_mulai' => '09:30:00',
                'jam_selesai' => '10:30:00',
                'terisi' => 0,
                'kuota' => 25,
            ],
            [
                'id_jenis_tes' => 4,
                'ruang' => 'B',
                'tanggal' => '2025-02-24 00:00:00.000',
                'jam_mulai' => '12:30:00',
                'jam_selesai' => '13:30:00',
                'terisi' => 0,
                'kuota' => 15,
            ],
            [
                'id_jenis_tes' => 3,
                'ruang' => 'B',
                'tanggal' => '2025-02-25 00:00:00.000',
                'jam_mulai' => '12:30:00',
                'jam_selesai' => '13:30:00',
                'terisi' => 0,
                'kuota' => 15,
            ],
            [
                'id_jenis_tes' => 1,
                'ruang' => 'A',
                'tanggal' => '2025-02-24 00:00:00.000',
                'jam_mulai' => '10:45:00', 
                'jam_selesai' => '11:45:00',
                'terisi' => 0,
                'kuota' => 25,
            ],
            [
                'id_jenis_tes' => 2,
                'ruang' => 'A',
                'tanggal' => '2025-02-24 00:00:00.000',
                'jam_mulai' => '10:45:00', 
                'jam_selesai' => '11:45:00',
                'terisi' => 0,
                'kuota' => 25,
            ],
            [
                'id_jenis_tes' => 4,
                'ruang' => 'B',
                'tanggal' => '2025-02-24 00:00:00.000',
                'jam_mulai' => '13:45:00',
                'jam_selesai' => '14:45:00',
                'terisi' => 0,
                'kuota' => 15,
            ],
            [
                'id_jenis_tes' => 3,
                'ruang' => 'B',
                'tanggal' => '2025-02-25 00:00:00.000',
                'jam_mulai' => '13:45:00',
                'jam_selesai' => '14:45:00',
                'terisi' => 0,
                'kuota' => 15,
            ],
        ];        

        foreach ($data as $record) {
            JadwalTes::firstOrCreate(
                [
                    'id_jenis_tes' => $record['id_jenis_tes'],
                    'ruang' => $record['ruang'],
                    'tanggal' => $record['tanggal'],
                    'jam_mulai' => $record['jam_mulai'],
                    'jam_selesai' => $record['jam_selesai'],
                ],
                [
                    'terisi' => $record['terisi'],
                    'kuota' => $record['kuota'],
                ]
            );
        }
    }
}
