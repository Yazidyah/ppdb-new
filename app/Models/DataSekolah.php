<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSekolah extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'data_sekolah';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'npsn',
        'sekolah_asal',
        'status_sekolah',
        'predikat_akreditasi_sekolah',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'nilai_akreditasi_sekolah' => 'integer',
    ];
}
