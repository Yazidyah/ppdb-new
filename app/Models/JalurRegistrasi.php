<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class JalurRegistrasi extends Model
{
    protected $table = 'jalur_registrasi';

    protected $primaryKey = 'id_jalur';

    protected $fillable = [
        'nama_jalur',
        'deskripsi',
        'tanggal_buka',
        'tanggal_tutup',
        'is_open',
    ];
    public $timestamps = true;

    public function persyaratan()
    {
        return $this->hasMany(Persyaratan::class, 'id_jalur', 'id_jalur');
    }

    public function jenisTes()
    {
        return $this->hasMany(JenisTes::class, 'id_jalur', 'id_jalur');
    }

    public function scopeOpenForRegistration($query)
    {
        $today = Carbon::today();

        return $query->where('is_open', true)
            ->where(function ($builder) use ($today) {
                $builder->whereNull('tanggal_buka')
                    ->orWhereDate('tanggal_buka', '<=', $today);
            })
            ->where(function ($builder) use ($today) {
                $builder->whereNull('tanggal_tutup')
                    ->orWhereDate('tanggal_tutup', '>=', $today);
            });
    }

    public function isCurrentlyOpen(): bool
    {
        if (!$this->is_open) {
            return false;
        }

        if ($this->tanggal_buka && Carbon::today()->lt(Carbon::parse($this->tanggal_buka))) {
            return false;
        }

        if (!$this->tanggal_tutup) {
            return true;
        }

        return Carbon::today()->lte(Carbon::parse($this->tanggal_tutup));
    }
}
