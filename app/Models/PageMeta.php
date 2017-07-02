<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageMeta extends Model
{
    protected $fillable = ['description', 'robots'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
