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
        
        JadwalTesModel::create([
            'id_jenis_tes' => $this->id_jenis_tes,
            'ruang'        => $this->ruang,
            'tanggal'      => $this->tanggal,
            'jam_mulai'    => $this->jam_mulai,
            'jam_selesai'  => $this->jam_selesai,
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
        $this->tanggal      = $tes->tanggal;
        $this->jam_mulai    = $tes->jam_mulai;
        $this->jam_selesai  = $tes->jam_selesai;
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

        $tes->update([
            'id_jenis_tes' => $this->id_jenis_tes,
            'ruang'        => $this->ruang,
            'tanggal'      => $this->tanggal,
            'jam_mulai'    => $this->jam_mulai,
            'jam_selesai'  => $this->jam_selesai,
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
