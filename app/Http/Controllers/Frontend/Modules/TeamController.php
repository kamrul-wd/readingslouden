<?php

namespace App\Http\Controllers\Frontend\Modules;

use App\Models\Page;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController
{
    public function index()
    {
        $page = Page::current()->first();
        $children = $page->descendants()->paginate(2);

        foreach ($children as $child) {
            $items = $child->getAncestorsAndSelf();

            foreach ($items as $key => $ancestors) {
                $rendered_slugs[$key] = $ancestors->slug;

                $rendered_slug = implode('/', $rendered_slugs);

                $child->href = url($rendered_slug);
            }
        }

        $view = view('templates.frontend.modules.team.list', compact('page', 'children'));
        $contents = $view->render();

        return $contents;
    }

    public function profile()
    {
        $page = Page::where('id', session('page_id'))->with('images')->first();

        $view = view('templates.frontend.modules.team.profile', compact('page'));
        $contents = $view->render();

        return $contents;
    }
}
