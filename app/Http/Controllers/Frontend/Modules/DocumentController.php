<?php

namespace App\Http\Controllers\Frontend\Modules;

use App\Models\Page;
use App\Http\Requests;
use Illuminate\Http\Request;

class DocumentController
{
    public function show()
    {
        $page = Page::where('id', session('page_id'))->with('documents')->first();

        $view = view('templates.frontend.modules.documents.list', compact('page'));
        return $view->render();
    }
}
