<?php

namespace App\Livewire\Usermanagement;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    public $filterRole;
    public $showDeleted = false;

    public function toggleShowDeleted()
    {
        $this->showDeleted = !$this->showDeleted;
    }

    public function render()
    {
        return view('livewire.usermanagement.index', [
            'users' => User::query()
                ->when(!empty($this->search), function ($p) {
                    $p->where('name', 'ilike', '%' . $this->search . '%')
                        ->orWhere('email', 'ilike', '%' . $this->search . '%');
                })
                ->when($this->filterRole, function ($q) {
                    $q->role($this->filterRole);
                })
                ->when($this->showDeleted, function ($q) {
                    $q->onlyTrashed(); 
                }, function ($q) {
                    $q->whereNull('deleted_at');
                })
                ->orderBy('id')
                ->paginate(10),
        ])->layout('layouts.app');
    }
}
