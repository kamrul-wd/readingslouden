<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Modules\ArticleController;
use App\Http\Controllers\Frontend\Modules\ContactController;
use App\Http\Controllers\Frontend\Modules\DocumentController;
use App\Http\Controllers\Frontend\Modules\BannerController;
use App\Http\Controllers\Frontend\Modules\InstagramController;
use App\Http\Controllers\Frontend\Modules\KitchenController;
use App\Http\Controllers\Frontend\Modules\MenuController;
use App\Http\Controllers\Frontend\Modules\TwitterController;
use App\Models\Page;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LayoutController extends Controller
{
    public function __construct(
        ArticleController $articleController,
        ContactController $contactController,
        BannerController $bannerController,
        KitchenController $kitchenController,
        InstagramController $instagramController,
        TwitterController $twitterController,
        DocumentController $documentController,
        MenuController $menuController
    ) {
        $this->article = $articleController;
        $this->contact = $contactController;
        $this->banner = $bannerController;
        $this->internal = $kitchenController;
        $this->instagram = $instagramController;
        $this->twitter = $twitterController;
        $this->document = $documentController;
        $this->menu = $menuController;
    }

    public function home()
    {
        $template = strtolower(session('template'));
        $topnav = $this->menu->main(1);
        $banners = $this->banner->index();
        $content = $this->article->getContent();
        $home_content = $this->article->getextraContent();
        $footer = $this->menu->footer();

        return view('templates.frontend.layouts.'.$template, compact(
            'template',
            'topnav',
            'banners',
            'content',
            'home_content',
            'footer'
        ));
    }

    public function defaultLayout()
    {
        $template = strtolower(session('template'));

        $topnav = $this->menu->main(1);
        $banners = $this->banner->index();
        $content = $this->article->getContent();
        $footer = $this->menu->footer();
//        $twitter = $this->twitter->index();

        return view('templates.frontend.layouts.'.$template, compact(
            'template',
            'topnav',
            'banners',
            'content',
            'footer'
        ));
    }

    public function instagram()
    {
        $template = strtolower(session('template'));

        $topnav = $this->menu->main(1);
        $banners = $this->banner->index();
        $instagram = $this->instagram->index();
        $content = $this->article->show();
        $footer = $this->menu->footer();

        return view('templates.frontend.layouts.'.$template, compact(
            'template',
            'topnav',
            'banners',
            'instagram',
            'content',
            'footer'
        ));
    }

    public function internal()
    {
        if (request()->ajax()) {
            return $this->internal->single();
            return;
        }

        $template = strtolower(session('template'));
        $topnav = $this->menu->main(1);
        $banners = $this->banner->index();
        $content = $this->internal->index();
        $footer = $this->menu->footer();

        return view('templates.frontend.layouts.'.$template, compact(
            'template',
            'topnav',
            'banners',
            'content',
            'footer'
        ));
    }

    public function contact()
    {
        $template = strtolower(session('template'));

        $topnav = $this->menu->main(1);
        $banners = $this->banner->index();
        $content = $this->article->show();
        $footer = $this->menu->footer();

        return view('templates.frontend.layouts.'.$template, compact(
            'template',
            'topnav',
            'banners',
            'content',
            'footer'
        ));
    }
}
