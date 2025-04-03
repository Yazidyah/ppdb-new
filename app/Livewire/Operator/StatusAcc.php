<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\CalonSiswa;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusAcc as StatusAccMail;
use App\Jobs\SendStatusAccEmail;

class StatusAcc extends Component
{
    public $modalOpen = false;
    public $siswa;
    public $status;
    public $statusList = [
        6 => 'Belum Ditentukan',
        7 => 'Tidak Diterima',
        8 => 'Diterima',
        9 => 'Dicadangkan',
    ];

    protected $listeners = ['openModal' => 'openModal'];
    public $buttonColor = '';
    public $buttonIcon = '';

    public function mount($siswa = null)
    {
        if ($siswa) {
            $this->siswa = $siswa;
            $this->initializeData();
        }
        $this->setButtonColor();
        $this->setButtonIcon();
    }

    protected function initializeData()
    {
        $dataRegistrasi = $this->siswa->dataRegistrasi;
        if ($dataRegistrasi) {
            $this->status = $dataRegistrasi->status;
        } else {
            $this->status = null;
        }
    }

    protected function setButtonColor()
    {
        if ($this->status == 7) {
            $this->buttonColor = 'bg-red-500 hover:bg-red-700';
        } elseif ($this->status == 8) {
            $this->buttonColor = 'bg-green-500 hover:bg-green-700';
        } elseif ($this->status == 9) {
            $this->buttonColor = 'bg-yellow-500 hover:bg-yellow-700';
        } else {
            $this->buttonColor = 'bg-blue-500 hover:bg-blue-700';
        }
    }

    protected function setButtonIcon()
    {
        $iconTemplate = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-auto">';

        if ($this->status == 8) {
            $this->buttonIcon = $iconTemplate . '<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>';
        } elseif ($this->status == 7) {
            $this->buttonIcon = $iconTemplate . '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>';
        } elseif ($this->status == 9) {
            $this->buttonIcon = $iconTemplate . '<path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>';
        } else {
            $this->buttonIcon = $iconTemplate . '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
</svg>
';
        }
    }

    public function openModal($id)
    {
        $this->siswa = CalonSiswa::findOrFail($id);
        $this->initializeData();
        $this->modalOpen = true;
    }

    public function simpan()
    {
        $this->validate([
            'status' => 'required|in:6,7,8,9',
        ]);

        $this->siswa->dataRegistrasi->status = $this->status;
        $this->siswa->dataRegistrasi->save();

        if (in_array($this->status, ['7', '8', '9'])) {
            $messageBody = $this->status === '8'
                ? "Selamat, Kamu telah diterima."
                : ($this->status === '7'
                    ? "Maaf, Kamu tidak diterima."
                    : "Kamu dicadangkan.");

            SendStatusAccEmail::dispatch($this->siswa, $messageBody, $this->status);
        }

        $this->modalOpen = false;
        return redirect()->route('operator.datasiswa')->with('success', 'Status berhasil diubah.');
    }

    public function render()
    {
        return view('livewire.operator.status-acc');
    }
}
