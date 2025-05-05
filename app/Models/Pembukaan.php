<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembukaan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pembukaan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'is_open',
        'start_date',
        'end_date'
    ];
}
