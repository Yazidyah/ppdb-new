<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTes extends Model
{
    use HasFactory;

    protected $table = 'data_tes';

    protected $fillable = [
        'id_registrasi',
        'id_jadwal_tes',
    ];

    public function registrasi()
    {
        return $this->belongsTo(DataRegistrasi::class, 'id_registrasi');
    }

    public function jadwalTes()
    {
        return $this->belongsTo(JadwalTes::class, 'id_jadwal_tes');
    }
}