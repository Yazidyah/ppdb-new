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

    public function jalur()
    {
        return $this->belongsTo(JalurRegistrasi::class, 'id_jalur');
    }

    public function syarat()
    {
        return $this->hasMany(Persyaratan::class, 'id_jalur', 'id_jalur');
    }

    // public function jalurRegistrasi()
    // {
    //     return $this->belongsTo(JalurRegistrasi::class, 'id_jalur');
    // }
}
