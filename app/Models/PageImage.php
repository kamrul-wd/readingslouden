<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    protected $fillable = [];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
