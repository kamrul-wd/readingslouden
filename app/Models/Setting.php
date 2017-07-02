<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['label', 'name', 'value'];

    public function scopeAdvanced($query)
    {
        return $query->where('advanced', 1);
    }

    public function scopeGeneral($query)
    {
        return $query->where('advanced', 0);
    }
}
