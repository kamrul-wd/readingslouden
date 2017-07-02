<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageExtra extends Model
{
    protected $fillable = ['browser_title', 'canonical', 'footer_code', 'body_class'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
