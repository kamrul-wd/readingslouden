<?php

namespace App\Http\Controllers\Frontend\Modules;

use App\Models\Page;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController
{
    public function show()
    {
        $page = Page::where('id', session('page_id'))->first();

        $view = view('templates.frontend.modules.product.list', compact('page'));
        $contents = $view->render();

        return $contents;
    }
}
