<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;
use App;

class FrontendRoutes
{
    /**
     * Define the authentication routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'namespace' => 'Frontend',
            'middleware' => 'find.page'
        ], function () use ($router) {
            $router->get('/', ['uses' => 'PageController@view', 'as' => 'index']);
            $router->get('{uri}', ['uses' => 'PageController@view', 'as' => 'page'])->where('uri', '.*');
        });

        $router->group([
            'namespace' => 'Frontend',
        ], function () use ($router) {
            $router->post('{uri}', ['uses' => 'PagePostController@index', 'as' => 'page_post']);
        });
    }
}
