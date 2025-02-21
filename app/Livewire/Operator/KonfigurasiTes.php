<?php
namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\Tes;
use App\Models\JenisTes;
use App\Models\JalurRegistrasi;
use Illuminate\Support\Facades\Log;

class KonfigurasiTes extends Component
{
    public $jadwalTes;
    public $nama_tes;
    public $editId;
    public $jenisTes;
    public $id_jenis_tes;
    public $jalurOptions;
    public $id_jalur;
    public $showModalJenis = false;
    public $showModalJadwal = false;
    public $ruang;
    public $tanggal;
    public $jam_mulai;
    public $jam_selesai;
    public $kuota;

    protected $rules = [
        'nama_tes' => 'required|string|max:255',
        'id_jalur' => 'required|exists:jalur_registrasi,id_jalur',
        'ruang' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i',
        'kuota' => 'required|integer',
    ];

    public function mount()
    {
        $this->jadwalTes = Tes::all();
        $this->jenisTes = JenisTes::with('jalurRegistrasi')->get();
        $this->jalurOptions = JalurRegistrasi::all();
    }

    public function render()
    {
        return view('livewire.operator.konfigurasi-tes', [
            'jenisTes' => $this->jenisTes,
        ]);
    }

    public function tambahJenis()
    {
        try {
            $this->validate([
                'nama_tes' => 'required|string|max:255',
                'id_jalur' => 'required|exists:jalur_registrasi,id_jalur',
            ]);
            Log::info('Validation passed for tambahJenis', ['nama_tes' => $this->nama_tes, 'id_jalur' => $this->id_jalur]);
            JenisTes::create([
                'nama' => $this->nama_tes,
                'id_jalur' => strval($this->id_jalur),
            ]);
            Log::info('JenisTes created successfully', ['nama_tes' => $this->nama_tes, 'id_jalur' => $this->id_jalur]);
            $this->showModalJenis = false;
            $this->mount();
        } catch (\Exception $e) {
            Log::error('Error in tambahJenis', ['message' => $e->getMessage()]);
            throw $e;
        }
    }

    public function editJenis($id)
    {
        $jenisTes = JenisTes::findOrFail($id);
        $this->editId = $id;
        $this->nama_tes = $jenisTes->nama;
        $this->id_jalur = $jenisTes->id_jalur;
        $this->showModalJenis = true;
    }

    public function simpanJenis()
    {
        $this->validate([
            'nama_tes' => 'required|string|max:255',
            'id_jalur' => 'required|exists:jalur_registrasi,id_jalur',
        ]);
        
        if ($this->editId) {
            $jenisTes = JenisTes::findOrFail($this->editId);
            $jenisTes->update([
                'nama' => $this->nama_tes,
                'id_jalur' => $this->id_jalur,
            ]);
        }
        $this->showModalJenis = false;
        $this->mount();
    }
    
    public function hapus($id)
    {
        JenisTes::findOrFail($id)->delete();
        $this->mount();
    }

    public function tambahJadwal()
    {
        Tes::create([
            'id_jenis_tes' => strval($this->id_jenis_tes),
            'ruang' => $this->ruang,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'kuota' => $this->kuota,
        ]);
        $this->showModalJadwal = false;
        $this->mount();
    }

    public function editJadwal($id)
    {
        $jadwalTes = Tes::findOrFail($id);
        $this->editId = $id;
        $this->id_jenis_tes = $jadwalTes->id_jenis_tes;
        $this->ruang = $jadwalTes->ruang;
        $this->tanggal = $jadwalTes->tanggal;
        $this->jam_mulai = $jadwalTes->jam_mulai;
        $this->jam_selesai = $jadwalTes->jam_selesai;
        $this->kuota = $jadwalTes->kuota;
        $this->showModalJadwal = true;
    }

    public function simpanJadwal()
    {
        $this->validate([
            'id_jenis_tes' => 'required|exists:jenis_tes,id_jenis_tes',
            'ruang' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'kuota' => 'required|integer',
        ]);
        
        if ($this->editId) {
            $jadwalTes = Tes::findOrFail($this->editId);
            $jadwalTes->update([
                'id_jenis_tes' => strval($this->id_jenis_tes),
                'ruang' => $this->ruang,
                'tanggal' => $this->tanggal,
                'jam_mulai' => $this->jam_mulai,
                'jam_selesai' => $this->jam_selesai,
                'kuota' => $this->kuota,
            ]);
        }
    
        $this->showModalJadwal = false;
        $this->mount();
    }

    public function hapusJadwal($id)
    {
        Tes::findOrFail($id)->delete();
        $this->mount();
    }
}
