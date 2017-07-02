<?php

namespace App\Http\Controllers\Frontend\Modules;

use App\Http\Requests;
use App\Models\PageBanner;
use Illuminate\Http\Request;

class BannerController
{
    public function index()
    {
        $banners = PageBanner::with('banners.media')
            ->where('page_id', session('page_id'))
            ->orderBy('order', 'asc')
            ->get();

        if (! $banners->count()) {
            return '';
        }

        $view = view('templates.frontend.modules.banners.main', compact('banners'));
        return $view->render();
    }
}
