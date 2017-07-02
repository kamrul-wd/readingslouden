<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageDocument extends Model
{
    protected $fillable = [];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
