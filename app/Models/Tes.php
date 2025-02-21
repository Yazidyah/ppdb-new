<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tes extends Model
{
    protected $table = 'tes';
    protected $fillable = [
        'id_jenis_tes',
        'ruang',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kuota',
    ];

    public function jenisTes()
    {
        return $this->belongsTo(JenisTes::class, 'id_jenis_tes', 'id');
    }
}
