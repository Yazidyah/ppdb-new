<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DataOperator extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $email, $password, $operator_id, $new_password;
    public $isOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ];

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->resetInputFields();
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'operator',
        ]);

        session()->flash('message', 'Operator successfully created.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $operator = User::findOrFail($id);
        $this->operator_id = $operator->id;
        $this->name = $operator->name;
        $this->email = $operator->email;
        $this->password = ''; 
        $this->new_password = '';
        $this->isOpen = true;
    }

    public function update()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->operator_id,
        ];

        if ($this->new_password) {
            $rules['new_password'] = 'min:6'; // Tidak required, hanya divalidasi jika diisi
        }

        $this->validate($rules);

        $operator = User::findOrFail($this->operator_id);
        $operator->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->new_password ? Hash::make($this->new_password) : $operator->password,
        ]);

        session()->flash('message', 'Operator updated successfully.');
        $this->closeModal();
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Operator deleted successfully.');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->operator_id = null;
        $this->new_password = '';
    }

    public function render()
    {
        return view('livewire.admin.data-operator', [
            'operators' => User::where('role', 'operator')->orderBy('id', 'asc')->paginate(10)
        ]);
    }
}