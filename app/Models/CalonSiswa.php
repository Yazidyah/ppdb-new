<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class CalonSiswa extends Model
{
    use SoftDeletes;

    protected $table = 'calon_siswa';

    protected $primaryKey = 'id_calon_siswa';

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
        'id_provinsi',
        'id_kota',
    ];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function berkas()
    {
        return $this->morphMany(Berkas::class, 'berkasable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getJenisKelaminReadableAttribute()
    {
        return $this->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getTanggalLahirFormattedAttribute()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->tanggal_lahir)->translatedFormat('j F Y');
    }

    public function dataRegistrasi()
{
    return $this->hasOne(DataRegistrasi::class, 'id_calon_siswa', 'id_calon_siswa');
}
}
