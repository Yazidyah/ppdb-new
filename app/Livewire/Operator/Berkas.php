<?php

namespace App\Livewire\Operator;

use App\Models\Berkas as ModelsBerkas;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Berkas extends Component
{
    public ModelsBerkas $berkas;
    public $preview = false;
    public $url;
    public $editable = true;
    public $verifikasi = false;

    public $openVerifikasi = false;
    public $viewVerifikasi = false;
    public $openCatatan = false;

    public $verify, $verify_notes;
    public $privy = false;
    public $privy_role = 'penerima';
    public $privy_step = 1;

    public function mount()
    {
        if ($this->verifikasi == true) {
            $this->viewVerifikasi = true;
        }
        $this->verify = $this->berkas->verify;
        $this->verify_notes = $this->berkas->verify_notes;
        if ($this->viewVerifikasi == true) {
            $this->openCatatan = true;
        }
    }

    public function download()
    {
        return Storage::disk($this->berkas->disk)->download($this->berkas->file_name, $this->berkas->original_name);
    }
    public function updatedPreview()
    {

        $this->url = Storage::disk($this->berkas->disk)->temporaryUrl($this->berkas->file_name, now()->addMinutes(5));
    }


    public function simpan()
    {
        $this->berkas->verify = $this->verify;
        $this->berkas->verify_notes = $this->verify_notes;
        $this->berkas->save();
        $this->openVerifikasi = false;
    }
    public function delete()
    {
        $this->berkas->delete();
        $this->emit('berkas-updated', $this->berkas->kategori_berkas_id);
    }

    public function render()
    {
        return view('livewire.operator.berkas');
    }
}
