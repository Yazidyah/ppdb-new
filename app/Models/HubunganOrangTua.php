<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HubunganOrangTua extends Model
{
    protected $table = 'hubungan_orang_tua';
    protected $primaryKey = 'id_hubungan'; 
    protected $fillable = [
        'nama_hubungan',
    ];
    public $timestamps = true;
}
