<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    protected $table = 'persyaratan';
    protected $primaryKey = 'id_persyaratan';
    protected $fillable = ['id_jalur', 'nama_persyaratan', 'deskripsi'];

    public function jalurRegistrasi()
    {
        return $this->belongsTo(JalurRegistrasi::class, 'id_jalur', 'id_jalur');
    }
}
