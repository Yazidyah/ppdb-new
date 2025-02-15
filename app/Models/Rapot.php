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
        return is_string($value) ? json_decode($value, true) : $value;
    }

    public static function calculateGrandAverageScore($averageScores)
    {
        $totalAverage = array_sum($averageScores);
        $semesterCount = count($averageScores);
        return $semesterCount > 0 ? round($totalAverage / $semesterCount, 3) : 0;
    }
}
