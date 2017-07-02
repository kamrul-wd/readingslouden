<?php

namespace App\Providers;

use App\Http\ViewComposers\PageComposer;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\FrontendMasterComposer;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     */
    public function boot(ViewFactory $view)
    {
        $view->composer(
            [
                'pages.backend.page.index',
                'pages.backend.page.show',
                'pages.backend.page.edit',
                'pages.backend.page.add',
                'pages.backend.page.create',
            ],
            PageComposer::class
        );

        $view->composer(
            [
                'templates.frontend.*',
                'errors.*'
            ],
            FrontendMasterComposer::class
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
