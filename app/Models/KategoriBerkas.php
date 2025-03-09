<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerkas extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'nama',
        'folder_name',
        'accepted_file_types',
        'max_file_size',
        'is_multiple',
        'disk',
        'created_at',
        'updated_at',
    ];

    public function berkas()
    {
        return $this->hasMany(Berkas::class);
    }

    public function kategoriPersyaratan()
    {
        return $this->belongsToMany(Persyaratan::class, 'kategori_persyaratan', 'id_kategori_berkas', 'id_persyaratan');
    }
}
