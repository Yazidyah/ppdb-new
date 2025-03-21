<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;


class Berkas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function temporaryUrl(): Attribute
    {
        return new Attribute(
            get: function (mixed $value, array $attributes) {
                return Storage::disk('local')->temporaryUrl(
                    base64_encode($attributes['file_name']),
                    now()->addHours(6)
                );
            },
        );
    }

    public function persyaratan()
    {
        return $this->belongsTo(Persyaratan::class, 'id_syarat', 'id_persyaratan');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriBerkas::class, 'kategori_berkas_id', 'id');
    }

    public function kategoriBerkas()
    {
        return $this->belongsTo(KategoriBerkas::class, 'kategori_berkas_id');
    }

    public function owner()
    {
        return $this->morphTo('owner', 'owner_type', 'owner_id');
    }

    public function morphModel()
    {
        return $this->morphTo('berkas', 'berkasable_type', 'berkasable_id');
    }
}
