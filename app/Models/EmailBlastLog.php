<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailBlastLog extends Model
{
    protected $fillable = [
        'batch_id',
        'jalur_type',
        'siswa_id',
        'email',
        'status',
        'sent_status',
        'error_message',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function scopePending($query)
    {
        return $query->where('sent_status', 'pending');
    }

    public function scopeSent($query)
    {
        return $query->where('sent_status', 'sent');
    }

    public function scopeFailed($query)
    {
        return $query->where('sent_status', 'failed');
    }

    public function scopeByBatch($query, $batchId)
    {
        return $query->where('batch_id', $batchId);
    }
}
