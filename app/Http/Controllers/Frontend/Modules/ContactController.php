<?php

namespace App\Http\Controllers\Frontend\Modules;

use App\Models\Page;
use App\Http\Requests;
use Illuminate\Http\Request;

class ContactController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $page = Page::where('id', session('page_id'))->first();

        $view = view('templates.frontend.modules.contact.basic', compact('page'));
        return $view->render();
    }


    private function getForm(){

    }


}
