<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Page;

class FindPageBySlug
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = $request->path();

        if ($url == '/') {
            $page = Page::where('id', 1)->first();
        } else {
            $explodedUrl = explode('/', $url);

            $urlArray = array();

            $indexCounter = 0;

            foreach ($explodedUrl as $segment) {
                $indexCounter++;
                $urlArray[$indexCounter] = $segment;
            }

            $slug = end($urlArray);
            $key = key($urlArray);

            $parent = prev($urlArray);

            $pages = Page::where('depth', $key)->where('slug', $slug)->where('active', 1)->get();

            foreach ($pages as $page) {
                if ($page->parent->slug == $parent) {
                    $page = Page::find($page->id);
                    break;
                }
            }

            if (! isset($page)) {
                $page = false;
            }
        }

        if (! $page) {
            abort(404);
        }

        if ($page->template) {
            $template = $page->template;
        } elseif ($page->parent()->pluck('child_template')) {
            $template = $page->parent()->pluck('child_template');
        } else {
            $template = 'defaultLayout';
        }

        session([
            'page_id' => $page->id,
            'template' => $template,
        ]);

        return $next($request);
    }
}
