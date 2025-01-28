<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'id_registrasi', 
        'id_syarat', 
        'tipe_dokumen', 
        'direktori_file', 
        'uploaded_at'
    ];
}
