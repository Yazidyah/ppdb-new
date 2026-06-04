<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\JadwalTes as JadwalTesModel;
use App\Models\JenisTes as JenisTesModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon; // Added for date formatting

class JadwalTes extends Component
{
    public $id_tes, $id_jenis_tes, $ruang, $tanggal, $jam_mulai, $jam_selesai, $kuota;
    public $jadwalTes, $jenisTes;
    public $isEdit = false;
    public $showModal = false;

    public $isTableVisible = true;
    public $confirmingDeleteId = null;
    
    protected $rules = [
        'id_jenis_tes' => 'required',
        'ruang' => 'required|string',
        'tanggal' => 'required|date',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i',
        'kuota' => 'required|integer',
    ];

    public function mount()
    {
        $this->jenisTes = JenisTesModel::all();
        $this->loadJadwalTes();
    }

    public function loadJadwalTes()
    {
        $this->jadwalTes = JadwalTesModel::orderBy('id_jenis_tes', 'asc')->get()->map(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
            return $item;
        });
    }

    public function create()
    {
        $this->reset(['id_tes', 'id_jenis_tes', 'ruang', 'tanggal', 'jam_mulai', 'jam_selesai', 'kuota']);
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();
        
        // Normalize tanggal to Y-m-d for DB and times to H:i
        $tanggalDb = Carbon::parse($this->tanggal)->format('Y-m-d');
        $jamMulai = Carbon::parse($this->jam_mulai)->format('H:i');
        $jamSelesai = Carbon::parse($this->jam_selesai)->format('H:i');

        JadwalTesModel::create([
            'id_jenis_tes' => $this->id_jenis_tes,
            'ruang'        => $this->ruang,
            'tanggal'      => $tanggalDb,
            'jam_mulai'    => $jamMulai,
            'jam_selesai'  => $jamSelesai,
            'kuota'        => $this->kuota,
        ]);

        $this->loadJadwalTes();
        $this->closeModal();
        session()->flash('message', 'Jadwal Tes berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tes = JadwalTesModel::find($id);

        if (!$tes) {
            session()->flash('error', 'Data tidak ditemukan.');
            return;
        }

        $this->id_tes       = $id;
        $this->id_jenis_tes = $tes->id_jenis_tes;
        $this->ruang        = $tes->ruang;
        // Ensure date input receives Y-m-d format
        $this->tanggal      = Carbon::parse($tes->tanggal)->format('Y-m-d');
        $this->jam_mulai    = Carbon::parse($tes->jam_mulai)->format('H:i');
        $this->jam_selesai  = Carbon::parse($tes->jam_selesai)->format('H:i');
        $this->kuota        = $tes->kuota;
        $this->isEdit       = true;
        $this->showModal    = true;
    }

    public function update()
    {
        $this->validate();

        $tes = JadwalTesModel::find($this->id_tes);

        if (!$tes) {
            session()->flash('error', 'Data tidak ditemukan.');
            return;
        }

        // Normalize tanggal and times before updating
        $tanggalDb = Carbon::parse($this->tanggal)->format('Y-m-d');
        $jamMulai = Carbon::parse($this->jam_mulai)->format('H:i');
        $jamSelesai = Carbon::parse($this->jam_selesai)->format('H:i');

        $tes->update([
            'id_jenis_tes' => $this->id_jenis_tes,
            'ruang'        => $this->ruang,
            'tanggal'      => $tanggalDb,
            'jam_mulai'    => $jamMulai,
            'jam_selesai'  => $jamSelesai,
            'kuota'        => $this->kuota,
        ]);

        $this->closeModal();
        $this->loadJadwalTes();
    }

    public function delete($id)
    {
        $tes = JadwalTesModel::find($id);

        if (!$tes) {
            session()->flash('error', 'Data tidak ditemukan.');
            return;
        }

        $tes->delete();
        $this->loadJadwalTes();
    }

    /**
     * Prompt confirmation modal (sets id to confirm)
     */
    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    /**
     * Cancel delete confirmation
     */
    public function cancelDelete()
    {
        $this->confirmingDeleteId = null;
    }

    /**
     * Actually delete the confirmed id
     */
    public function deleteConfirmed()
    {
        if (!$this->confirmingDeleteId) {
            return;
        }

        $tes = JadwalTesModel::find($this->confirmingDeleteId);

        if (!$tes) {
            session()->flash('error', 'Data tidak ditemukan.');
            $this->confirmingDeleteId = null;
            return;
        }

        $tes->delete();
        $this->confirmingDeleteId = null;
        $this->loadJadwalTes();
        session()->flash('message', 'Jadwal Tes berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['id_tes', 'id_jenis_tes', 'ruang', 'tanggal', 'jam_mulai', 'jam_selesai', 'kuota']);
        $this->showModal = false;
    }

    public function toggleTable()
    {
        $this->isTableVisible = !$this->isTableVisible;
        Cookie::queue('isTableVisible', $this->isTableVisible ? 'true' : 'false', 60 * 24);
    }

    public function render()
    {
        return view('livewire.operator.jadwal-tes', [
            'jadwalTes' => $this->jadwalTes,
            'jenisTes'  => $this->jenisTes,
        ]);
    }
}
