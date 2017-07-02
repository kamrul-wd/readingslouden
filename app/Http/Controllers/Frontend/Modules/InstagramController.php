<?php

namespace App\Http\Controllers\Frontend\Modules;

use App\Models\Page;
use App\Models\PageImage;
use Vinkla\Instagram\Instagram;

class InstagramController
{
    public function index()
    {
        $instagaram = new Instagram();

        $items = $instagaram->get('martinsofhawkhurst');

        $main_item = $items;

        $items = array_chunk($items, 3);

        $view = view('templates.frontend.modules.instagram.list', compact('items','main_item'));
        return $view->render();
    }

    public function single()
    {
        $page = Page::where('id', session('page_id'))->with('images')->first();

        $view = view('templates.frontend.modules.kitchen.single', compact('page'));
        return $view->render();
    }
}
