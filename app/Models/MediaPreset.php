<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaPreset extends Model
{
    protected $fillable = ['name', 'width', 'height', 'cropper'];

    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
