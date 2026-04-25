<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPersyaratan extends Model
{
    use HasFactory;

    protected $table = 'kategori_persyaratan';
    protected $fillable = [
        'id_persyaratan',
        'id_kategori_berkas',
    ];
}
