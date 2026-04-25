<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'siswa@example.com'],
            [
                'name' => 'Siswa User',
                'role' => 'siswa',
                'password' => bcrypt('password'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'operator@example.com'],
            [
                'name' => 'Operator User',
                'role' => 'operator',
                'password' => bcrypt('password'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'role' => 'admin',
                'password' => bcrypt('password'),
            ]
        );

        $this->call(HubunganOrangTuaSeeder::class);
        $this->call(JalurRegistrasiSeeder::class);
        $this->call(PekerjaanOrtuSeeder::class);
        $this->call(KategoriBerkasSeeder::class);
        $this->call(PersyaratanSeeder::class);
        $this->call(JenisTesSeeder::class);
        $this->call(JadwalTesSeeder::class);
        $this->call(KategoriPersyaratanSeeder::class);
        $this->call(IndoRegionProvinceSeeder::class);
        $this->call(IndoRegionRegencySeeder::class);
    }
}
