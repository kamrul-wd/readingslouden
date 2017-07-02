<?php
namespace App\Http\Controllers\Frontend\Modules;

use App\Models\Page;
use App\Models\PageImage;

/**
 * Created by PhpStorm.
 * User: kam
 * Date: 09/05/2017
 * Time: 16:27
 */




class KitchenController
{
    public function index()
    {
        $page = Page::current()->first();
        $gallarys = $page->children()->get();
        $gallarys = $gallarys->where('active', 1);


        foreach($gallarys as $gallary){
            $gallary->featureImage = PageImage::with('media')
                ->where('page_id', $gallary->id)
                ->orderBy('order', 'asc')
                ->first();
        }

        $gallary_main = $gallarys->chunk(3);


        // Generate the slug
        $rendered_slugs = [];
        foreach ($page->getAncestorsAndSelf() as $ancestors) {
            $rendered_slugs[] = $ancestors->slug;
        }
        $rendered_slug = implode('/', $rendered_slugs);

        $view = view('templates.frontend.modules.kitchen.list', compact('page', 'gallary_main', 'rendered_slug'));
        return $view->render();
    }

    private function transformArray(array $initialArray, $chunkSize = 3) {
        if (count($initialArray) % $chunkSize != 0) {
            throw new \Exception('The length of $initialArray must be divisible by ' . $chunkSize);
        }

        $chunks = array_chunk($initialArray, 3);
        $result = [];

        foreach ($chunks as $chunk) {
            $newItem = [];

            foreach ($chunk as $item) {
                $newItem[array_keys($item)[0]] = reset($item);
            }

            $result[] = $newItem;
        }

        return $result;
    }

    public function single()
    {
        $page = Page::where('id', session('page_id'))->with('images')->first();

        $view = view('templates.frontend.modules.kitchen.single', compact('page'));
        return $view->render();
    }
}
