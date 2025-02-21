<?php
namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\Tes;
use App\Models\JenisTes;

class TestSchedule extends Component
{
    public $testSchedules;
    public $nama_tes;
    public $jadwal_tes;
    public $editId;
    public $jenisTesOptions;
    public $id_jenis_tes;

    protected $rules = [
        'nama_tes' => 'required|string|max:255',
        'jadwal_tes' => 'required|date',
        'id_jenis_tes' => 'required|exists:jenis_tes,id',
    ];

    public function mount()
    {
        $this->testSchedules = Tes::all();
        $this->jenisTesOptions = JenisTes::all();
    }

    public function render()
    {
        return view('livewire.operator.test-schedule');
    }

    public function create()
    {
        $this->validate();
        Tes::create([
            'nama_tes' => $this->nama_tes,
            'jadwal_tes' => $this->jadwal_tes,
            'id_jenis_tes' => $this->id_jenis_tes,
        ]);
        $this->resetInputFields();
        $this->testSchedules = Tes::all();
    }

    public function edit($id)
    {
        $testSchedule = Tes::findOrFail($id);
        $this->editId = $id;
        $this->nama_tes = $testSchedule->nama_tes;
        $this->jadwal_tes = $testSchedule->jadwal_tes;
        $this->id_jenis_tes = $testSchedule->id_jenis_tes;
    }

    public function update()
    {
        $this->validate();
        $testSchedule = Tes::findOrFail($this->editId);
        $testSchedule->update([
            'nama_tes' => $this->nama_tes,
            'jadwal_tes' => $this->jadwal_tes,
            'id_jenis_tes' => $this->id_jenis_tes,
        ]);
        $this->resetInputFields();
        $this->testSchedules = Tes::all();
    }

    public function delete($id)
    {
        Tes::findOrFail($id)->delete();
        $this->testSchedules = Tes::all();
    }

    private function resetInputFields()
    {
        $this->nama_tes = '';
        $this->jadwal_tes = '';
        $this->id_jenis_tes = null;
        $this->editId = null;
    }
}
