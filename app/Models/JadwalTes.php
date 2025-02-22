<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTes extends Model
{
    use HasFactory;

    protected $table = 'jadwal_tes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_jenis_tes',
        'ruang',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kuota',
    ];

    public function jenisTes()
    {
        return $this->belongsTo(JenisTes::class, 'id_jenis_tes');
    }
}
