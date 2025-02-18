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
        User::factory()->create([
            'name' => 'Siswa User',
            'email' => 'siswa@example.com',
            'role' => 'siswa',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Operator User',
            'email' => 'operator@example.com',
            'role' => 'operator',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        $this->call(HubunganOrangTuaSeeder::class);
        $this->call(JalurRegistrasiSeeder::class);
        $this->call(PekerjaanOrtuSeeder::class);
        $this->call(KategoriBerkasSeeder::class);
        $this->call(PersyaratanSeeder::class);
        $this->call(IndoRegionProvinceSeeder::class);
        $this->call(IndoRegionRegencySeeder::class);
    }
}
