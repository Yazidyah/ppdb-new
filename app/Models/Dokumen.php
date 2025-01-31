<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'id_registrasi', 
        'id_syarat', 
        'nama_dokumen', 
        'data_dokumen',
        'direktori_file', 
        'uploaded_at'
    ];
    public function registrasi()
    {
        return $this->belongsTo(DataRegistrasi::class, 'id_registrasi');
    }
    public function syarat()
    {
        return $this->belongsTo(Persyaratan::class, 'id_syarat');
    }
}

