<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PekerjaanOrangTua extends Model
{
    protected $table = 'pekerjaan_orang_tua';
    protected $primaryKey = 'id_pekerjaan';
    protected $fillable = ['nama_pekerjaan'];
}
