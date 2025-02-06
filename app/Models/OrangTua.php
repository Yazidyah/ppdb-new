<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $fillable = [
        'id_calon_siswa',
        'id_hubungan',
        'nama_lengkap',
        'nik',
        'pekerjaan',
        'no_telp',
    ];

    protected $table = 'orang_tua';
    protected $primaryKey = 'id_orang_tua'; // Specify the primary key column

    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'id_calon_siswa');
    }

    public function hubungan()
    {
        return $this->belongsTo(HubunganOrangTua::class, 'id_hubungan');
    }

    public function kerjaan()
    {
        return $this->belongsTo(PekerjaanOrangTua::class, 'pekerjaan', 'id_pekerjaan');
    }
}
