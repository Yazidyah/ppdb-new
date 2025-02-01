<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRegistrasi extends Model
{
    protected $table = 'data_registrasi';
    protected $primaryKey = 'id_registrasi';
    protected $fillable = [
        'id_calon_siswa',
        'id_jalur',
        'status',
        'tanggal_daftar'
    ];

    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'id_calon_siswa');
    }

    // public function jalurRegistrasi()
    // {
    //     return $this->belongsTo(JalurRegistrasi::class, 'id_jalur');
    // }
}
