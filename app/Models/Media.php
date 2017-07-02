<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['label'];

    public function banner()
    {
        return $this->hasMany(Banner::class);
    }

    public function preset()
    {
        return $this->hasOne(MediaPreset::class, 'id', 'media_preset_id');
    }

    public function original()
    {
        return $this->hasOne(Media::class);
    }

    public function pageDocuments()
    {
        return $this->hasMany(PageDocument::class, 'media_id', 'id');
    }

    public function pageImages()
    {
        return $this->hasMany(PageImage::class, 'media_id', 'id');
    }

    public function scopeImages($query)
    {
        return $query->where('file_type', 'images');
    }

    public function scopeDocuments($query)
    {
        return $query->where('file_type', 'documents');
    }

    public function scopeIsPreset($query)
    {
        return $query->has('preset');
    }

    public function scopePresetTypes($query, $presets = [])
    {
        return $query->whereIn('media_preset_id', $presets);
    }

    public function scopeIsOriginal($query)
    {
        return $query->whereNull('media_preset_id');
    }
}
