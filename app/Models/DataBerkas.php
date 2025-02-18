<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBerkas extends Model
{
    use HasFactory;

    protected $table = 'data_berkas';

    protected $fillable = [
        'id_berkas',
        'data_berkas',
    ];
}
