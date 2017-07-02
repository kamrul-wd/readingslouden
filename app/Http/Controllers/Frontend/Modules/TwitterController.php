<?php
namespace App\Http\Controllers\Frontend\Modules;

use App\Models\Page;
use App\Models\PageImage;
use Thujohn\Twitter\Facades\Twitter;
use Vinkla\Instagram\Instagram;

/**
 * Created by PhpStorm.
 * User: kam
 * Date: 09/05/2017
 * Time: 16:27
 */




class TwitterController
{
    public function index()
    {
        $twitter = Twitter::getUserTimeline(['screen_name' => 'kamrul_sscis', 'count' => 20, 'format' => 'json']);
//        dd($twitter);


        $view = view('templates.frontend.modules.instagram.list', compact('items','main_item'));
        return $view->render();
    }
}
