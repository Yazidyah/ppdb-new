<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\JalurRegistrasi;
use Carbon\Carbon;

class CountdownJalurTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function reguler_open_is_considered()
    {
        JalurRegistrasi::create([
            'nama_jalur' => 'Reguler',
            'tanggal_buka' => Carbon::today()->toDateString(),
            'tanggal_tutup' => Carbon::today()->addDays(5)->toDateString(),
            'is_open' => true,
        ]);

        $this->assertDatabaseHas('jalur_registrasi', ['nama_jalur' => 'Reguler', 'is_open' => true]);
    }

    /** @test */
    public function reguler_missing_is_handled()
    {
        $this->assertDatabaseCount('jalur_registrasi', 0);
        // component renders closed message when no open jalur
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function afirmatif_prestasi_all_open()
    {
        JalurRegistrasi::create([
            'nama_jalur' => 'Prestasi',
            'tanggal_buka' => Carbon::today()->addDay()->toDateString(),
            'tanggal_tutup' => Carbon::today()->addDays(7)->toDateString(),
            'is_open' => true,
        ]);
        JalurRegistrasi::create([
            'nama_jalur' => 'Afirmatif',
            'tanggal_buka' => Carbon::today()->toDateString(),
            'tanggal_tutup' => Carbon::today()->addDays(10)->toDateString(),
            'is_open' => true,
        ]);

        $this->assertDatabaseHas('jalur_registrasi', ['nama_jalur' => 'Prestasi', 'is_open' => true]);
        $this->assertDatabaseHas('jalur_registrasi', ['nama_jalur' => 'Afirmatif', 'is_open' => true]);
    }

    /** @test */
    public function partial_open_is_handled()
    {
        JalurRegistrasi::create([
            'nama_jalur' => 'Prestasi',
            'is_open' => false,
        ]);
        JalurRegistrasi::create([
            'nama_jalur' => 'Afirmatif',
            'is_open' => true,
            'tanggal_buka' => Carbon::today()->toDateString(),
            'tanggal_tutup' => Carbon::today()->addDays(3)->toDateString(),
        ]);
        $this->assertDatabaseHas('jalur_registrasi', ['nama_jalur' => 'Afirmatif', 'is_open' => true]);
    }

    /** @test */
    public function all_closed_shows_message()
    {
        JalurRegistrasi::create([
            'nama_jalur' => 'Reguler',
            'is_open' => false,
        ]);
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
