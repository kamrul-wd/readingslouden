<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Search Results';
        $search_term = $request->q;

        if ($request->has('q')) {
            $results = Page::with('banners', 'images')
                ->where('heading', 'LIKE', '%' . $search_term . '%')
                ->orWhere('slug', 'LIKE', '%' . $search_term . '%')
                ->orWhere('excerpt', 'LIKE', '%' . $search_term . '%')
                ->orWhere('content', 'LIKE', '%' . $search_term . '%')
                ->paginate(10);
            //return $results;

            if (! $results->count()) {
                return back()
                    ->with('error', 'No results found for that search term.');
            }

            foreach ($results as &$result) {
                $page = Page::find($result->id);

                $rendered_slugs = [];
                foreach ($page->getAncestorsAndSelf() as $ancestors) {
                    $rendered_slugs[] = $ancestors->slug;
                }

                $result->rendered_slug = implode('/', $rendered_slugs);
            }
            //return $results;

            $results_pagination = $results->appends(['q' => $search_term]);

            return view('pages.backend.search.results', compact(
                'title',
                'results',
                'search_term',
                'results_pagination'
            ))
                ->with('success', 'Here\'s your search results');
        }

        return redirect()->route('admin.dashboard.index')->with('error', 'No search term entered.');
    }
}
