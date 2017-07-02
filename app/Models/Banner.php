<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['heading', 'text', 'link'];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_banners', 'banner_id', 'page_id')->orderBy('order');
    }
}
