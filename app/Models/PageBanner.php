<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageBanner extends Model
{
    public function banners()
    {
        return $this->belongsTo(Banner::class, 'banner_id');
    }
}
