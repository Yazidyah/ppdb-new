<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rapot extends Model
{
    protected $table = 'rapot';

    protected $fillable = [
        'id_registrasi',
        'nilai_rapot',
    ];

    public function registrasi()
    {
        return $this->belongsTo(DataRegistrasi::class, 'id_registrasi', 'id_registrasi');
    }
}
