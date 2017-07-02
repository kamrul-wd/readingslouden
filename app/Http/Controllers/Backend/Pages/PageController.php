<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Models\Page;
use App\Models\Media;
use App\Models\Banner;
use App\Http\Requests;
use App\Models\PageImage;
use App\Models\PageBanner;
use App\Models\PageDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __construct()
    {
        // Check the tree is valid. Fix if needed.
        if (! Page::isValidNestedSet()) {
            Page::rebuild(); // add true as first param to force index rebuilding.
        }
    }

    private function finalRequestFields($request)
    {
        // Only save admin fields if master
        if (auth()->user()->hasRole('master')) {
            return $request->all();
        }

        return $request->except(['template', 'child_template', 'protected']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Pages';

        $root = Page::find(1);
        //return $root;

        //$pages = $root->getImmediateDescendants(); // changed so we can use 'where' etc
        $pages = $root->children()->where('on_main_nav', 1)->get();
        //return $pages;

        $hidden = $root->children()->where('on_main_nav', 0)->get();

        return view('pages.backend.page.index', compact('title', 'root', 'pages', 'hidden'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Page';

//        $extra_js = [
//            asset('assets/libs/tinymce/tinymce.min.js'),
//            asset('assets/libs/tinymce/jquery.tinymce.min.js'),
//        ];
        //return $extra_js;

        $rendered_slug = '';

        $available_images = Media::presetTypes(config('cms.image_presets'))->get();
        $selected_images = [];
        $image_order = '';

        $available_documents = Media::documents()->get();
        $selected_documents = [];
        $document_order = '';

        $available_banners = Banner::with('media')->get();
        $selected_banners = [];
        $banner_order = '';

        return view('pages.backend.page.create', compact(
            'title',
            'available_images',
            'selected_images',
            'image_order',
            'available_documents',
            'selected_documents',
            'document_order',
            'available_banners',
            'selected_banners',
            'banner_order',
            'extra_js',
            'rendered_slug'
        ));
    }

    /**
     * Show the form for adding a new sub page.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $parent_page = Page::find($id);
        //return $parent_page;

        $title = 'Create Sub Page in '.$parent_page->heading;

//        $extra_js = [
//            asset('assets/libs/tinymce/tinymce.min.js'),
//            asset('assets/libs/tinymce/jquery.tinymce.min.js'),
//        ];
        //return $extra_js;

        $rendered_slugs = [];
        foreach ($parent_page->getAncestorsAndSelf() as $ancestors) {
            $rendered_slugs[] = $ancestors->slug;
        }
        $rendered_slug = implode('/', $rendered_slugs);

        $available_images = Media::presetTypes(config('cms.image_presets'))->get();
        $selected_images = [];
        $image_order = '';

        $available_documents = Media::documents()->get();
        $selected_documents = [];
        $document_order = '';

        $available_banners = Banner::with('media')->whereDoesntHave('pages', function ($query) use ($id) {
            $query->where('page_id', $id);
        })->get();
        $selected_banners = [];
        $banner_order = '';

        return view('pages.backend.page.add', compact(
            'title',
            'parent_page',
            'available_images',
            'selected_images',
            'image_order',
            'available_documents',
            'selected_documents',
            'document_order',
            'available_banners',
            'selected_banners',
            'banner_order',
            'parent_page',
            'extra_js',
            'rendered_slug'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\PageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\PageRequest $request)
    {
        // Always set parent_id to 1 (home) by default.
        if (! $request->parent_id) {
            $request->merge(['parent_id' => 1]);
        }

        // Set checkboxes that aren't checked (default value), if it's not set in the form.
        if (! $request->active) {
            $request->merge(['active' => 0]);
        }
        if (! $request->on_main_nav) {
            $request->merge(['on_main_nav' => 0]);
        }
        if (! $request->protected) {
            $request->merge(['protected' => 0]);
        }

        $parent = Page::find($request->parent_id);

        // Sort out the fields for certain groups.
        $finalRequest = $this->finalRequestFields($request);

        if (! $page = Page::create($finalRequest)->makeLastChildOf($parent)) {
            return back()
                ->withInput()
                ->with('error', 'Could not create that page.');
        }

        $meta = $page->meta ?: $page->meta()->getRelated();
        $meta->page()->associate($page);
        $meta->fill($finalRequest)->save();

        $extra = ($page->extra) ?: $page->extra()->getRelated();
        $extra->page()->associate($page);
        $extra->fill($finalRequest)->save();

        // Get the banners and sync with order
        if (! $request->banner_order) {
            $bannersPivotData = [];
        } else {
            $order = explode(',', $request->banner_order);
            $bannersPivotData = [];
            foreach ($order as $key => $ordering) {
                if (Banner::find($ordering)) {
                    $bannersPivotData[$ordering]['order'] = $key + 1;
                }
            }
        }
        $page->banners()->sync($bannersPivotData);

        // Get the documents and sync with order
        if (! $request->document_order) {
            $documentsPivotData = [];
        } else {
            $order = explode(',', $request->document_order);
            $documentsPivotData = [];
            foreach ($order as $key => $ordering) {
                if (Media::documents()->find($ordering)) {
                    $documentsPivotData[$ordering]['order'] = $key + 1;
                }
            }
        }
        $page->documents()->sync($documentsPivotData);

        // Get the images and sync with order
        if (! $request->image_order) {
            $imagesPivotData = [];
        } else {
            $order = explode(',', $request->image_order);
            $imagesPivotData = [];
            foreach ($order as $key => $ordering) {
                if (Media::images()->find($ordering)) {
                    $imagesPivotData[$ordering]['order'] = $key + 1;
                }
            }
        }
        $page->images()->sync($imagesPivotData);

        if ($request->parent_id == 1) {
            return redirect()
                ->route('admin.pages.edit', $page->id)
                ->with('success', 'Created that page.');
        }

        return redirect()
            ->route('admin.pages.edit', $page->id)
            ->with('success', 'Created that sub page.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // If trying to view home page
        if ($id == 1) {
            return redirect()
                ->route('admin.pages.index');
        }

        if (! $page = Page::find($id)) {
            return redirect()
                ->route('admin.pages.index')
                ->with('message', 'Could not find that page.');
        }
        //return $page;

        $descendants = $page->getImmediateDescendants();
        //return $descendants;

        $title = 'List Pages In '.$page->heading;

        return view('pages.backend.page.show', compact('title', 'page', 'descendants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! $page = Page::where('id', $id)->with('banners.media', 'meta', 'extra')->first()) {
            return redirect()
                ->route('admin.pages.index')
                ->with('error', 'Could not find that page.');
        }

        $title = 'Edit Page: '.$page->heading;

//        $extra_js = [
//            asset('assets/libs/tinymce/tinymce.min.js'),
//            asset('assets/libs/tinymce/jquery.tinymce.min.js'),
//        ];
        //return $extra_js;

        $rendered_slugs = [];
        foreach ($page->getAncestors() as $ancestors) {
            $rendered_slugs[] = $ancestors->slug;
        }
        $rendered_slug = implode('/', $rendered_slugs);

        $available_images = Media::images()
            ->presetTypes(config('cms.image_presets'))
            ->whereDoesntHave('pageImages', function ($query) use ($id) {
                $query->where('page_id', $id);
            })->get();

        $selected_images = PageImage::with('media')
            ->where('page_id', $id)
            ->orderBy('order', 'asc')
            ->get();

        $image_order = implode(',', $selected_images->pluck('media_id')->all());

        $available_documents = Media::documents()
            ->whereDoesntHave('pageDocuments', function ($query) use ($id) {
                $query->where('page_id', $id);
            })->get();

        $selected_documents = PageDocument::with('media')
             ->where('page_id', $id)
             ->orderBy('order', 'asc')
             ->get();

        $document_order = implode(',', $selected_documents->pluck('banner_id')->all());

        $available_banners = Banner::with('media')
            ->whereDoesntHave('pages', function ($query) use ($id) {
                $query->where('page_id', $id);
            })->get();

        $selected_banners = PageBanner::with('banners.media')
             ->where('page_id', $id)
             ->orderBy('order', 'asc')
             ->get();

        $banner_order = implode(',', $selected_banners->pluck('banner_id')->all());

        // check if it is home page then process extra content
        $home_content = '';
        if($page->template == 'home') {
            $extra_content = $page->extra_content;
            if (!empty($extra_content)) {
                $home_content = \GuzzleHttp\json_decode($extra_content);
            }

        }


        return view('pages.backend.page.edit', compact(
            'title',
            'page',
            'available_images',
            'selected_images',
            'image_order',
            'available_documents',
            'selected_documents',
            'document_order',
            'available_banners',
            'selected_banners',
            'banner_order',
            'extra_js',
            'rendered_slug',
            'home_content'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\PageRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\PageRequest $request, $id)
    {
        if (! $page = Page::find($id)) {
            return redirect()
                ->route('admin.pages.index')
                ->with('error', 'Could not find that page.');
        }

        $home_content = array();
//        $home_content['home_content'] = $request->extra_content;
        $request->merge(['extra_content' => \GuzzleHttp\json_encode($request->extra_content)]);
//        dd($request->extra_content);
//        dd($request);


        // Set checkboxes that aren't checked (default value), if it's not set in the form.
        if (! $request->active) {
            $request->merge(['active' => 0]);
        }
        if (! $request->on_main_nav) {
            $request->merge(['on_main_nav' => 0]);
        }
        if (! $request->protected) {
            $request->merge(['protected' => 0]);
        }

        $meta = $page->meta ?: $page->meta()->getRelated();
        $meta->page()->associate($page);
        $meta->fill($request->all())->save();

        $extra = ($page->extra) ?: $page->extra()->getRelated();
        $extra->page()->associate($page);
        $extra->fill($request->all())->save();

        // Get the banners and sync with order
        if (! $request->banner_order) {
            $bannersPivotData = [];
        } else {
            $order = explode(',', $request->banner_order);
            $bannersPivotData = [];
            foreach ($order as $key => $ordering) {
                if (Banner::find($ordering)) {
                    $bannersPivotData[$ordering]['order'] = $key + 1;
                }
            }
        }
        $page->banners()->sync($bannersPivotData);

        // Get the documents and sync with order
        if (! $request->document_order) {
            $documentsPivotData = [];
        } else {
            $order = explode(',', $request->document_order);
            $documentsPivotData = [];
            foreach ($order as $key => $ordering) {
                if (Media::documents()->find($ordering)) {
                    $documentsPivotData[$ordering]['order'] = $key + 1;
                }
            }
        }
        $page->documents()->sync($documentsPivotData);

        // Get the images and sync with order
        if (! $request->image_order) {
            $imagesPivotData = [];
        } else {
            $order = explode(',', $request->image_order);
            $imagesPivotData = [];
            foreach ($order as $key => $ordering) {
                if (Media::images()->find($ordering)) {
                    $imagesPivotData[$ordering]['order'] = $key + 1;
                }
            }
        }
        $page->images()->sync($imagesPivotData);

        // Sort out the fields for certain groups.
        $finalRequest = $this->finalRequestFields($request);

        if (! $page->update($finalRequest)) {
            return back()
                ->withInput()
                ->with('error', 'Failed to edited that page.');
        }

        if ($page->parent_id == 1) {
            return redirect()
                ->route('admin.pages.edit', $page->id)
                ->with('success', 'Edited that page.');
        }

        return redirect()
            ->route('admin.pages.edit', $page->id)
            ->with('success', 'Edited that page.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $page = Page::find($id)) {
            return back()
                ->with('error', 'Could not find that page.');
        }

        if ($page->protected) {
            return back()
                ->with('error', 'Could not delete that page as it is protected.');
        }

        if ($page->children()->count() && ! Page::where('lft', '>', $page->lft)
            ->where('rgt', '<', $page->rgt)
            ->orderBy('lft', 'desc')
            ->delete()) {
            return back()
                ->with('error', 'Could not delete the subs.');
        }

        if (! $page->delete()) {
            return back()
                ->with('error', 'Could not delete that page.');
        }

        Page::rebuild();

        return back()
            ->with('success', 'Deleted that page and any subs.');
    }

    /**
     * Copy a page in its current location
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function copy($id)
    {
        if (! $page = Page::find($id)) {
            return back()
                ->with('error', 'Failed to find that page.');
        }
        //return $page;

        $page->heading = $page->heading.' [Copy]';
        $page->slug = $page->slug.'-copy-'.str_random(6);

        $new_page = Page::create($page->toArray())->makeNextSiblingOf($page);

        if ($page->meta) {
            $meta = $new_page->meta ?: $new_page->meta()->getRelated();
            $meta->page()->associate($new_page);
            $meta->fill($page->meta->toArray())->save();
        }

        if ($page->extra) {
            $extra = $new_page->extra ?: $new_page->extra()->getRelated();
            $extra->page()->associate($new_page);
            $extra->fill($page->extra->toArray())->save();
        }

        if (! $new_page) {
            return back()
                ->with('error', 'Failed to copy that page.');
        }

        return back()
            ->with('success', 'Copied that page');
    }

    /**
     * Move a page to a different level
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function move(Request $request, $id)
    {
        if (! $page = Page::find($id)) {
            return back()
                ->with('error', 'Failed to find that page.');
        }

        if (! $request->new_parent) {
            return back()
                ->with('error', 'Please select a parent page.');
        }

        if (! $new_parent = Page::find($request->new_parent)) {
            return back()
                ->with('error', 'Failed to find that parent page.');
        }

        $move_page = $page->makeLastChildOf($new_parent);

        if (! $move_page) {
            return back()
                ->with('error', 'Failed to move that page.');
        }

        return back()
            ->with('success', 'Moved that page.');
    }

    public function reOrder(Request $request)
    {
        if (! $page = Page::find($request->id)) {
            return [
                'error'   => true,
                'message' => 'Could not find that page.',
            ];
        }

        if ($request->left_sibling_id === 'parent') {
            $parent = ($page->isRoot() ? Page::root() : Page::find($page->parent_id));
            //return $parent;

            if (! $page->makeFirstChildOf($parent)) {
                return [
                    'error'   => true,
                    'message' => 'Could not move that page.',
                ];
            }
        } else {
            $left_page = Page::find($request->left_sibling_id);
            if (! $page->makeNextSiblingOf($left_page)) {
                return [
                    'error'   => true,
                    'message' => 'Could not move that page.',
                ];
            }
        }

        return [
            'error'   => false,
            'message' => 'Moved that page.',
        ];
    }

    public function toggleActive(Request $request)
    {
        if (! $page = Page::find($request->id)) {
            return [
                'error'   => true,
                'message' => 'Failed to find that page.',
            ];
        }

        // Set the active column 0 or 1 depending on the current value.
        $page->active = ($page->active ? 0 : 1);

        if (! $page->save()) {
            return [
                'error'   => true,
                'message' => 'Failed to toggle that page.',
                'state'   => $page->active,
            ];
        }

        return [
            'error'   => false,
            'message' => '',
            'state'   => $page->active,
        ];
    }
}
