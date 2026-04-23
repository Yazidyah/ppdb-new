<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataRegistrasi extends Model
{
    use SoftDeletes;
    protected $table = 'data_registrasi';
    protected $primaryKey = 'id_registrasi';
    protected $fillable = [
        'id_calon_siswa',
        'id_jalur',
        'nomor_peserta',
        'nomor_suket',
        'status',
        'id_jadwal_tes',
        'is_active',
    ];
    protected $dates = ['deleted_at', 'updated_at'];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

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

    public function rapot()
    {
        return $this->hasOne(Rapot::class, 'id_registrasi', 'id_registrasi');
    }

    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'uploader_id', 'id_calon_siswa');
    }

    public function jadwalTes()
    {
        return $this->belongsTo(JadwalTes::class, 'id_jadwal_tes', 'id');
    }

    public function dataTes()
    {
        return $this->hasMany(DataTes::class, 'id_registrasi'); // Updated to hasMany
    }
}
