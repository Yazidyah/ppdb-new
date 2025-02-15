<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rapot extends Model
{
    protected $table = 'rapot';
    protected $primaryKey = 'id_rapot';

    protected $fillable = [
        'id_registrasi',
        'nilai_rapot',
        'total_rata_nilai',
    ];

    public function registrasi()
    {
        return $this->belongsTo(DataRegistrasi::class, 'id_registrasi', 'id_registrasi');
    }

    public function getNilaiRapotAttribute($value)
    {
        return json_decode($value, true);
    }
}
