<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    use HasFactory;

    protected $table = 'statistik';

    protected $fillable = [
        'nama_statistik',
        'count',
        'updated_at',
    ];

    public $timestamps = false;

    const UPDATED_AT = 'updated_at';
}
