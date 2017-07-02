<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __construct(LayoutController $layoutService)
    {
        $this->layoutService = $layoutService;
    }

    /**
     * Display index of the resource
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
        $template = session('template');

        if (method_exists($this->layoutService, $template)
            && is_callable(array($this->layoutService, $template))) {
            return call_user_func(
                array($this->layoutService, $template)
            );
        }

        session(['template' => 'defaultLayout']);

        return call_user_func(
            array($this->layoutService, 'defaultLayout')
        );
    }
}
