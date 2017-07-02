<?php

namespace App\Helpers;

use Cache;
use App\Models\Setting;

class Pingala
{
    /*
    |--------------------------------------------------------------------------
    | Show Settings
    |--------------------------------------------------------------------------
    |
    | Return a certain setting from the database via a key and cache it
    |
    */
    public static function setting($name)
    {
        if (Cache::has('setting_' . $name)) {
            return Cache::get('setting_' . $name);
        }

        $setting = Setting::where('name', $name)->first();

        if ($setting) {
            Cache::forever('setting_' . $name, $setting->value);
        }

        return $setting;
    }

    public static function bytesToHuman($bytes)
    {
        $units = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public static function extensionToIconClass($extension)
    {
        if (in_array($extension, ['docx', 'doc'])) {
            return 'fa-file-word-o';
        } elseif ($extension == 'pdf') {
            return 'fa-file-pdf-o';
        } elseif (in_array($extension, ['xlsx', 'xls'])) {
            return 'fa-file-excel-o';
        } elseif (in_array($extension, ['pptx', 'ppt'])) {
            return 'fa-file-powerpoint-o';
        }

        return 'fa-file-o';
    }
}
