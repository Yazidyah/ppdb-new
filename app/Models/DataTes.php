<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DataTes extends Model
{
    use HasFactory;

    protected $table = 'data_tes';

    protected $fillable = [
        'id_registrasi',
        'id_jadwal_tes',
    ];

    protected static function boot()
    {
        parent::boot();

        // Apply default sorting by id in ascending order
        static::addGlobalScope('orderById', function (Builder $builder) {
            $builder->orderBy('id', 'asc');
        });
    }

    public function registrasi()
    {
        return $this->belongsTo(DataRegistrasi::class, 'id_registrasi');
    }

    public function jadwalTes()
    {
        return $this->belongsTo(JadwalTes::class, 'id_jadwal_tes');
    }
}