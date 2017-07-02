<?php

namespace App\Http\ViewComposers;

use App\Helpers\Pingala;
use App\Models\Page;
use Illuminate\Contracts\View\View;

class FrontendMasterComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     */
    public function compose(View $view)
    {
        $page = Page::current()->with('extra', 'meta')->first();

        if (! isset($page->extra->browser_title)) {
            $browser_title = $page->heading;
        } else {
            $browser_title = $page->extra->browser_title;
        }

//        //nav bar
//        $topnav_s = new MenuController();
//        $top_navtwo = $topnav_s->main();
//        $view->with('topnav_s', $top_navtwo);


        // General
        $view->with('browser_title', $browser_title);

        // Body class
        $body_class = '';
        if(isset($page->extra->body_class)){
            $body_class = $page->extra->body_class;
        }

        $view->with('body_class', $body_class);

        // Meta
        $view->with('meta_description', (isset($page->meta->description) ? $page->meta->description : ''));
        $view->with('meta_robots', (isset($page->meta->robots) ? $page->meta->robots : ''));
        $view->with('wmt_id', Pingala::setting('wmt_id'));
        $view->with('ga_code', Pingala::setting('ga_code'));

        // Social
        $view->with('social_facebook_url', Pingala::setting('social_facebook_url'));
        $view->with('social_twitter_url', Pingala::setting('social_twitter_url'));
        $view->with('social_linkedin_url', Pingala::setting('social_linkedin_url'));
        $view->with('social_google_plus_url', Pingala::setting('social_google_plus_url'));
        $view->with('social_youtube_url', Pingala::setting('social_youtube_url'));
        $view->with('m_phone', Pingala::setting('m_phone'));
        $view->with('m_top_heading', Pingala::setting('m_top_heading'));
        $view->with('footer_right', Pingala::setting('footer_right_text'));

    }
}
