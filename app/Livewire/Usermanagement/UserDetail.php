<?php

namespace App\Livewire\Usermanagement;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\CalonSiswa;

class UserDetail extends Component
{

    public User $user;
    public $isOpen = false;
    public $newPassword;
    public $canLoginAs = false;
    public $showRoleAndPermission = false;

    protected $rules = [
        'newPassword' => 'nullable',
    ];
    public $createdAt;

    public function mount()
    {
        $this->createdAt = Carbon::parse($this->user->created_at)->locale('id')->isoFormat('LLLL');
    }

    public function resetPassword()
    {
        $this->newPassword = Hash::make($this->newPassword);
        $this->validate();
        $this->user->update(['password' => $this->newPassword]);
    }

    public function loginAs()
    {
        session()->forget('password_hash_sanctum');
        session()->put('login_as', auth()->id());

        Auth::logout();
        Auth::login($this->user);

        return redirect()->route('home');
    }

    public function setRegistrasiStatus($status)
    {
        if ($this->user->role !== 'siswa') {
            session()->flash('error', 'Aksi hanya tersedia untuk pengguna dengan role siswa.');
            return;
        }

        $calon = CalonSiswa::where('id_user', $this->user->id)->first();
        if (! $calon) {
            session()->flash('error', 'Calon siswa tidak ditemukan.');
            return;
        }

        $registrasi = $calon->dataRegistrasi()->first();
        if (! $registrasi) {
            session()->flash('error', 'Data registrasi tidak ditemukan.');
            return;
        }

        $current = $registrasi->status;
        if (is_null($current)) {
            session()->flash('error', 'Status saat ini tidak tersedia.');
            return;
        }

        $target = (int) $status;

        // Disallow moving forward; only allow moving to a previous (smaller) status
        if ($target >= (int) $current) {
            session()->flash('error', 'Hanya boleh memundurkan status (tidak bisa maju).');
            return;
        }

        $registrasi->update(['status' => $target]);
        session()->flash('message', 'Status registrasi berhasil dipindahkan.');
        $this->dispatch('registrasiUpdated');
    }

    public function render()
    {
        return view('livewire.usermanagement.user-detail');
    }
}
