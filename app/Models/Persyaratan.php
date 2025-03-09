<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    use HasFactory;
    protected $table = 'persyaratan';
    protected $primaryKey = 'id_persyaratan';
    protected $fillable = ['id_jalur', 'nama_persyaratan', 'deskripsi'];

    public function berkas()
    {
        return $this->morphMany(Berkas::class, 'berkasable');
    }

    public function jalurRegistrasi()
    {
        return $this->belongsTo(JalurRegistrasi::class, 'id_jalur', 'id_jalur');
    }

    public function kategoriBerkas()
    {
        return $this->belongsToMany(KategoriBerkas::class, 'kategori_persyaratan', 'id_persyaratan', 'id_kategori_berkas');
    }
}
