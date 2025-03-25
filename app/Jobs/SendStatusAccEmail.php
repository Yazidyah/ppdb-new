<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusAcc;

class SendStatusAccEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $siswa;
    protected $messageBody;
    protected $status;

    /**
     * Create a new job instance.
     */
    public function __construct($siswa, $messageBody, $status)
    {
        $this->siswa = $siswa;
        $this->messageBody = $messageBody;
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        Mail::to($this->siswa->user->email)->send(new StatusAcc(
            $this->siswa,
            $this->messageBody,
            $this->status
        ));
    }
}
