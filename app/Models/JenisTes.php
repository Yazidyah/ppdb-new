<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisTes extends Model
{
    protected $table = 'jenis_tes';

    protected $fillable = [
        'id_jalur',
        'nama',
    ];

    public function jalurRegistrasi()
    {
        return $this->belongsTo(JalurRegistrasi::class, 'id_jalur', 'id_jalur');
    }
}
