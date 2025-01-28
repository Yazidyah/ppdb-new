<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $fillable = [
        'id_calon_siswa',
        'id_hubungan',
        'nama_lengkap',
        'pekerjaan',
        'no_telp',
    ];

    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'id_calon_siswa');
    }

    public function hubungan()
    {
        return $this->belongsTo(HubunganOrangTua::class, 'id_hubungan');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(PekerjaanOrangTua::class, 'id_pekerjaan');
    }
}
