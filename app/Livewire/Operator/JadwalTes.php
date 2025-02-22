<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\Tes;
use App\Models\JenisTes as JenisTesModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class JadwalTes extends Component
{
    public $id_tes, $id_jenis_tes, $ruang, $tanggal, $jam_mulai, $jam_selesai, $kuota;
    public $jadwalTes, $jenisTes;
    public $isEdit = false;
    public $showModal = false;

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
        // Ambil semua data jenis tes
        $this->jenisTes = JenisTesModel::all();
        // Load data jadwal tes dengan join agar nama jenis tes tersedia
        $this->loadJadwalTes();
    }

    public function loadJadwalTes()
    {
        // Lakukan join dengan melakukan cast pada kolom jenis_tes.id_jenis_tes ke VARCHAR
        $this->jadwalTes = Tes::query()
            ->join('jenis_tes', function($join) {
                $join->on(DB::raw("CAST(jenis_tes.id_jenis_tes AS VARCHAR)"), '=', 'tes.id_jenis_tes');
            })
            ->select('tes.*', 'jenis_tes.nama as nama_jenis_tes')
            ->get();
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

        Tes::create([
            'id_jenis_tes' => $this->id_jenis_tes,
            'ruang'        => $this->ruang,
            'tanggal'      => $this->tanggal,
            'jam_mulai'    => $this->jam_mulai,
            'jam_selesai'  => $this->jam_selesai,
            'kuota'        => $this->kuota,
        ]);

        $this->loadJadwalTes();
        $this->closeModal();
    }

    public function edit($id)
    {
        $tes = Tes::find($id);

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
        \Log::info('Update method called');

        try {
            \Log::info('Starting validation', [
                'id_jenis_tes' => $this->id_jenis_tes,
                'ruang' => $this->ruang,
                'tanggal' => $this->tanggal,
                'jam_mulai' => $this->jam_mulai,
                'jam_selesai' => $this->jam_selesai,
                'kuota' => $this->kuota,
            ]);

            $this->validate();

            \Log::info('Validation passed');
        } catch (\Exception $e) {
            \Log::error('Validation failed', ['error' => $e->getMessage()]);
            session()->flash('error', 'Validation failed: ' . $e->getMessage());
            return;
        }

        $tes = Tes::find($this->id_tes);

        if (!$tes) {
            \Log::error('Tes not found', ['id_tes' => $this->id_tes]);
            session()->flash('error', 'Data tidak ditemukan.');
            return;
        }

        // Log the data being updated
        \Log::info('Updating Tes', [
            'id_tes' => $this->id_tes,
            'id_jenis_tes' => $this->id_jenis_tes,
            'ruang' => $this->ruang,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'kuota' => $this->kuota,
        ]);

        $tes->update([
            'id_jenis_tes' => $this->id_jenis_tes,
            'ruang'        => $this->ruang,
            'tanggal'      => $this->tanggal,
            'jam_mulai'    => $this->jam_mulai ? date('H:i', strtotime($this->jam_mulai)) : $tes->jam_mulai,
            'jam_selesai'  => $this->jam_selesai ? date('H:i', strtotime($this->jam_selesai)) : $tes->jam_selesai,
            'kuota'        => $this->kuota,
        ]);

        \Log::info('Tes updated successfully');

        $this->closeModal();
        $this->loadJadwalTes();
    }

    public function delete($id)
    {
        $tes = Tes::find($id);

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

    public function render()
    {
        return view('livewire.operator.jadwal-tes', [
            'jadwalTes' => $this->jadwalTes,
            'jenisTes'  => $this->jenisTes,
        ]);
    }
}
