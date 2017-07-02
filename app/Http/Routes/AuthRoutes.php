<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class AuthRoutes
{
    /**
     * Define the authentication routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'namespace' => 'Backend\Auth',
            'prefix' => 'admin',
        ], function () use ($router) {

            get('login', [
                'as' => 'admin.auth.login',
                'uses' => 'AuthController@getLogin',
            ]);

            post('login', 'AuthController@postLogin');

            get('logout', [
                'as' => 'admin.auth.logout',
                'uses' => 'AuthController@getLogout',
            ]);

            get('password/email', [
                'as' => 'admin.password.email',
                'uses' => 'PasswordController@getEmail',
            ]);

            post('password/email', 'PasswordController@postEmail');

            get('password/reset/{token}', [
                'as' => 'admin.password.reset.token',
                'uses' => 'PasswordController@getReset',
            ]);

            post('password/reset', [
                'as' => 'admin.password.reset',
                'uses' => 'PasswordController@postReset',
            ]);
        });

        $router->group([
            'namespace' => 'Auth',
        ], function () use ($router) {

            get('login', [
                'as' => 'auth.login',
                'uses' => 'AuthController@getLogin'
            ]);

            post('login', 'AuthController@postLogin');

            get('logout', [
                'as' => 'auth.logout',
                'uses' => 'AuthController@getLogout'
            ]);

            get('password/email', [
                'as' => 'password.email',
                'uses' => 'PasswordController@getEmail',
            ]);

            post('password/email', 'PasswordController@postEmail');

            get('password/reset/{token}', [
                'as' => 'password.reset.token',
                'uses' => 'PasswordController@getReset',
            ]);

            post('password/reset', [
                'as' => 'password.reset',
                'uses' => 'PasswordController@postReset'
            ]);
        });
    }
}
