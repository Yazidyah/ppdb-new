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
    public $timestamps = true;

    public function persyaratan()
    {
        return $this->hasMany(Persyaratan::class, 'id_jalur', 'id_jalur');
    }

    public function jenisTes()
    {
        return $this->hasMany(JenisTes::class, 'id_jalur', 'id_jalur');
    }
}
