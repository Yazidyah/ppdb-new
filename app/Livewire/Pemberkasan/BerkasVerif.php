<?php

namespace App\Livewire\Pemberkasan;

use App\Models\Berkas as ModelsBerkas;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class BerkasVerif extends Component
{
    public ModelsBerkas $berkas;
    public $preview = true;
    public $url;
    public $editable = true;

    public function mount()
    {
        $this->berkas->load('kategoriBerkas'); // Ensure the relationship is loaded
        $this->updatedPreview();
    }

    public function getNomorText(): string
    {
        $kategoriNama = $this->berkas->kategoriBerkas->nama ?? 'Belum diisi';
        $dataBerkas = $this->berkas->data_berkas ?? 'Belum diisi';

        return "Nomor {$kategoriNama} : {$dataBerkas}";
    }

    public function isException(): bool
    {
        $nama = strtolower($this->berkas->kategoriBerkas->nama);

        return str_contains($nama, 'foto') || // Updated to check for "foto"
               str_starts_with($nama, 'rapot') ||
               str_starts_with($nama, 'rapor') ||
               str_starts_with($nama, 'raport') ||
               str_contains($nama, 'kelahiran');
    }

    public function download()
    {
        return Storage::disk($this->berkas->disk)->download($this->berkas->file_name, $this->berkas->original_name);
    }

    public function updatedPreview()
    {
        $encodedPath = base64_encode($this->berkas->file_name);

        $this->url = route('local.temp', ['path' => $encodedPath]);
    }

    public function simpan()
    {
        $this->berkas->verify = $this->verify;
        $this->berkas->verify_notes = $this->verify_notes;
        $this->berkas->save();
    }

    public function delete()
    {
        $this->berkas->delete();
        // $this->dispatch('berkas-updated', kategoriBerkasId: $this->berkas->kategori_berkas_id);
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.pemberkasan.berkas-verif');
    }
}
