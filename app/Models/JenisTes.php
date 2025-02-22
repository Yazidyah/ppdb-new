<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTes extends Model
{
    use HasFactory;

    protected $table = 'jenis_tes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'no_jalur',
        'nama',
    ];

    public function tes()
    {
        return $this->hasMany(JadwalTes::class, 'id_jenis_tes', 'id');
    }
}
