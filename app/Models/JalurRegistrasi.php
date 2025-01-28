<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalurRegistrasi extends Model
{
    protected $table = 'jalur_registrasi';

    protected $primaryKey = 'id_jalur';

    protected $fillable = [
        'nama_jalur',
        'deskripsi',
        'tanggal_buka',
        'tanggal_tutup',
        'is_open',
    ];
}
