<?php

namespace Tests\Feature\Auth;

use App\Models\JalurRegistrasi;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        JalurRegistrasi::create([
            'nama_jalur' => 'Reguler',
            'deskripsi' => 'Jalur reguler',
            'tanggal_buka' => Carbon::today()->subDay()->toDateString(),
            'tanggal_tutup' => Carbon::today()->addDay()->toDateString(),
            'is_open' => true,
        ]);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('siswa.dashboard', absolute: false));
    }
}
