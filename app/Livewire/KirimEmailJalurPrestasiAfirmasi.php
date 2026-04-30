<?php

namespace App\Livewire;

use App\Models\CalonSiswa;
use App\Models\EmailBlastLog;
use Livewire\Component;
use App\Jobs\SendStatusAccEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class KirimEmailJalurPrestasiAfirmasi extends Component
{
    public $siswa;
    public $totalEmail = 0;
    public $batchId;
    public $progress = 0;
    public $totalSent = 0;
    public $totalFailed = 0;
    public $isProcessing = false;
    public $canResume = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->siswa = CalonSiswa::whereHas('dataRegistrasi', function($query) {
            $query->where('id_jalur', '!=', 1)
                  ->whereIn('status', [6, 7, 8]);
        })
        ->whereNull('deleted_at')
        ->with(['user', 'dataRegistrasi'])
        ->get();
        
        $this->totalEmail = $this->siswa->count();
        
        $latestBatch = EmailBlastLog::where('jalur_type', 'prestasi_afirmasi')
            ->orderBy('created_at', 'desc')
            ->first();
        
        if ($latestBatch) {
            $this->batchId = $latestBatch->batch_id;
            $this->updateProgress();
            
            $pendingCount = EmailBlastLog::byBatch($this->batchId)->pending()->count();
            $this->canResume = $pendingCount > 0;
        }
    }

    public function updateProgress()
    {
        if (!$this->batchId) return;
        
        $this->totalSent = EmailBlastLog::byBatch($this->batchId)->sent()->count();
        $this->totalFailed = EmailBlastLog::byBatch($this->batchId)->failed()->count();
        
        $total = EmailBlastLog::byBatch($this->batchId)->count();
        if ($total > 0) {
            $this->progress = round((($this->totalSent + $this->totalFailed) / $total) * 100);
        }
    }

    public function kirimEmail()
    {
        $this->isProcessing = true;
        $this->batchId = Str::uuid()->toString();
        
        $emailQueue = [];
        
        foreach ($this->siswa as $s) {
            if (!$s->dataRegistrasi || !$s->user || !$s->user->email) {
                continue;
            }

            if (!filter_var($s->user->email, FILTER_VALIDATE_EMAIL)) {
                Log::warning('Email tidak valid: ' . $s->user->email);
                continue;
            }

            $emailQueue[] = [
                'batch_id' => $this->batchId,
                'jalur_type' => 'prestasi_afirmasi',
                'siswa_id' => $s->id_calon_siswa,
                'email' => $s->user->email,
                'status' => $s->dataRegistrasi->status,
                'sent_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (empty($emailQueue)) {
            session()->flash('error', 'Tidak ada email yang valid untuk dikirim');
            $this->isProcessing = false;
            return;
        }

        EmailBlastLog::insert($emailQueue);
        
        $this->dispatchEmails();
        
        session()->flash('success', "Email blast dimulai! Total: " . count($emailQueue) . " email. Proses berjalan di background.");
        $this->isProcessing = false;
        $this->canResume = false;
        $this->loadData();
    }

    public function resumeEmail()
    {
        if (!$this->batchId) {
            session()->flash('error', 'Tidak ada batch yang dapat dilanjutkan');
            return;
        }

        $this->isProcessing = true;
        $this->dispatchEmails();
        
        session()->flash('success', "Melanjutkan pengiriman email...");
        $this->isProcessing = false;
        $this->loadData();
    }

    protected function dispatchEmails()
    {
        $pendingEmails = EmailBlastLog::byBatch($this->batchId)
            ->pending()
            ->get();

        foreach ($pendingEmails as $log) {
            $siswa = CalonSiswa::with(['user', 'dataRegistrasi'])->find($log->siswa_id);
            
            if (!$siswa) continue;

            $messageBody = match((int)$log->status) {
                7 => "Selamat! Anda telah diterima di MAN 1 Kota Bogor",
                6 => "Pemberitahuan Hasil Seleksi PPDB MAN 1 Kota Bogor",
                8 => "Anda masuk dalam daftar cadangan MAN 1 Kota Bogor",
                default => "Update Status Pendaftaran PPDB MAN 1 Kota Bogor"
            };

            SendStatusAccEmail::dispatch($siswa, $messageBody, $log->status, $log->id);
        }
    }

    public function refreshProgress()
    {
        $this->updateProgress();
    }

    public function render()
    {
        return view('livewire.kirim-email-jalur-prestasi-afirmasi');
    }
}
