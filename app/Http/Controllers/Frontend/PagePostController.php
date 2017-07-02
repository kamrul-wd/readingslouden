<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\Forms\MainContactController;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagePostController extends Controller
{
    public function __construct(MainContactController $mainContactController)
    {
        $this->mainContactController = $mainContactController;
    }

    /**
     * Display index of the resource
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $controller_name = camel_case($request->method_name)."Controller";

        if (class_exists('App\Http\Controllers\Frontend\Forms\\'.ucfirst($controller_name))) {
            return $this->$controller_name->index($request);
        }

        return abort(404);
    }
}
