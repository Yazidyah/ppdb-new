<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTes extends Model
{
    use HasFactory;

    protected $table = 'jenis_tes';
    protected $primaryKey = 'id_jenis_tes';

    protected $fillable = [
        'id_jalur',
        'nama',
    ];

    public function jalurRegistrasi()
    {
        return $this->belongsTo(JalurRegistrasi::class, 'id_jalur', 'id_jalur');
    }

    public function tes()
    {
        return $this->hasMany(Tes::class, 'id_jenis_tes', 'id');
    }
}
