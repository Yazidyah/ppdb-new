<?php

namespace App\Livewire\Usermanagement;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

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

    public function render()
    {
        return view('livewire.usermanagement.user-detail');
    }
}
