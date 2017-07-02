<?php

namespace App\Http\Controllers\Frontend\Modules;

use Nav;
use App\Models\Page;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;

class MenuController
{
    public function side($depth = 1)
    {
        try {
            $menu = Nav::handler('side_nav');

            Nav::handler('side_nav')->hydrate(function () {
                if (Page::current()->active()->first()->depth <= 1) {
                    $current = Page::current()->active()->first();
                    $items = $current->getImmediateDescendants();
                } else {
                    $current = Page::currentRoot()->active()->first();
                    $items = $current->getDescendantsAndSelf();
                }

                $items = $items->map(function ($item) {
                    if ($item['depth'] == 2) {
                        $item['parent_id'] = null;
                    }

                    return $item;
                });

                if (count($items) == 0) {
                    throw new Exception;
                }

                return $items;
            }, function ($children, $item) {
                $rendered_slugs = [];
                foreach ($item->getAncestorsAndSelf() as $ancestors) {
                    $rendered_slugs[] = $ancestors->slug;
                }
                $rendered_slug = implode('/', $rendered_slugs);

                $children->add($rendered_slug, $item->heading, Nav::items($item->slug));
            });
        } catch (Exception $e) {
            return [];
        }


        return $menu;
    }

    public function main($depth = 1)
    {
        $menu = Nav::handler('main');

        $menu->addClass('navbar-nav mr-auto mt-lg-0');

        Nav::handler('main')->hydrate(function () use ($depth) {
            $current = Page::root()->first();

            $items = $current->descendantsAndSelf()->limitDepth($depth)->active()->get();

            $items = $items->map(function ($item) {
                if ($item->parent_id == 1) {
                    $item['parent_id'] = null;
                }
                return $item;
            });

            $items = $items->filter(function ($item) {
                return $item->on_main_nav;
            });

            return $items;
        }, function ($children, $item) {
            $rendered_slugs = [];
            foreach ($item->getAncestorsAndSelf() as $ancestors) {
                $rendered_slugs[] = $ancestors->slug;
            }
            $rendered_slug = implode('/', $rendered_slugs);
            $children->add($rendered_slug, $item->heading, Nav::items($item->slug));
        });

        $menu
            ->getItemsByContentType('Menu\Items\Contents\Link')
            ->map(function ($item) {
                $url1 = Request::segment(1);
                $url2 = Request::segment(2);

                if ($item->hasChildren()) {
                    $item
                        ->getContent()
                        ->addClass('dropdown-toggle')
                        ->setAttribute('data-toggle', 'dropdown')
                        ->setAttribute('aria-haspopup', 'true')
                        ->setAttribute('aria-expanded', 'false')
                        ->setAttribute('id', 'navbarDropdownMenuLink');
                    $item->addClass('dropdown');

                    $item->getChildren()
                        ->addClass('dropdown-menu')
                        ->setAttribute('aria-labelledby', 'navbarDropdownMenuLink');
                }




                $url_seperator = explode('/', $item->getContent()->getUrl());

                if (count($url_seperator) > 2) {
                    $item->addClass('dropdown-item');
                    $item->getContent()->addClass('dropdown-item');
                } else {
                    $item->getContent()->addClass('nav-link');
                    $item->addClass('nav-item');
                }

                // puting external link
                if ($item->getContent()->getUrl() == '/appliances') {
                    $item->getContent()->href('https://www.martinsdirect.co.uk');
                    $item->getContent()->rel('noopener noreferrer');
                    $item->getContent()->target('_balnk');
                }

                if ($item->getContent()->getUrl() == '/'.$url1.'/'.$url2) {
                    $item->addClass('dropdown');
                }
            });

        return $menu;
    }

    public function bootstrap_menu($depth = 1)
    {
        $menu = Nav::handler('main');
        $menu->addClass('navbar-nav');

        Nav::handler('main')->hydrate(function () use ($depth) {
            $current = Page::root()->first();

            $items = $current->descendantsAndSelf()->limitDepth($depth)->active()->get();

            $items = $items->map(function ($item) {
                if ($item->parent_id == 1) {
                    $item['parent_id'] = null;
                }
                return $item;
            });

            $items = $items->filter(function ($item) {
                return $item->on_main_nav;
            });

            return $items;
        }, function ($children, $item) {
            $rendered_slugs = [];
            foreach ($item->getAncestorsAndSelf() as $ancestors) {
                $rendered_slugs[] = $ancestors->slug;
            }
            $rendered_slug = implode('/', $rendered_slugs);
            $children->add($rendered_slug, $item->heading, Nav::items($item->slug));
        });

        $menu
            ->getItemsByContentType('Menu\Items\Contents\Link')
            ->map(function ($item) {
                $url1 = Request::segment(1);
                $url2 = Request::segment(2);

                if ($item->hasChildren()) {
                    $item
                        ->getContent()
                        ->addClass('dropdown-toggle')
                        ->setAttribute('data-toggle', 'dropdown')
                        ->setAttribute('aria-haspopup', 'true')
                        ->setAttribute('aria-expanded', 'false')
                        ->setAttribute('id', 'navbarDropdownMenuLink');
                    $item->addClass('dropdown');

                    $item->getChildren()
                        ->addClass('dropdown-menu')
                        ->setAttribute('aria-labelledby', 'navbarDropdownMenuLink');
                }


                $url_seperator = explode('/', $item->getContent()->getUrl());

                if (count($url_seperator) > 2) {
                    $item->addClass('dropdown-item');
                    $item->getContent()->addClass('dropdown-item');
                } else {
                    $item->getContent()->addClass('nav-link');
                    $item->addClass('nav-item');
                }

                if ($item->getContent()->getUrl() == '/'.$url1.'/'.$url2) {
                    $item->addClass('dropdown');
                }
            });

        return $menu;
    }

    public function footer()
    {
        $menu = Nav::handler('footer');

        $menu
            ->add('legal/terms-conditions', 'Terms and Conditions')
            ->add('legal/privacy', 'Privacy');

        $menu
            ->addClass('nav navbar-nav')
            ->getItemsByContentType(Menu\Items\Contents\Link::class)
            ->map(function ($item) {
                if ($item->isActive()) {
                    $item->addClass('active');
                }
            });

        return $menu;
    }
}
