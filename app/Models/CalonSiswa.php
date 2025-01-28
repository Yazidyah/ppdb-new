<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalonSiswa extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_user',
        'nama_lengkap',
        'NIK',
        'NISN',
        'no_telp',
        'jenis_kelamin',
        'is_active',
        'tanggal_lahir',
        'tempat_lahir',
        'NPSN',
        'sekolah_asal',
        'alamat_domisili',
        'alamat_kk',
    ];
}
