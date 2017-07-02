<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class AdminRoutes
{
    /**
     * Define the admin routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'namespace' => 'Backend',
            'prefix' => 'admin',
            'middleware' => ['auth', 'admin'],
        ], function () use ($router) {
            get('/', [
                'as' => 'admin.dashboard.index',
                'uses' => 'DashboardController@index',
            ]);

            get('search', [
                'as' => 'admin.search',
                'uses' => 'SearchController@index',
            ]);

            post('contact', [
                'as' => 'admin.contact.post',
                'uses' => 'DashboardController@postContact',
            ]);

            $router->group([
                'namespace' => 'Pages',
            ], function () use ($router) {
                resource('pages', 'PageController');

                get('pages/{id}/add', [
                    'as' => 'admin.pages.add',
                    'uses' => 'PageController@add',
                ]);

                post('pages/{id}/copy', [
                    'as' => 'admin.pages.copy',
                    'uses' => 'PageController@copy',
                ]);

                post('pages/{id}/move', [
                    'as' => 'admin.pages.move',
                    'uses' => 'PageController@move',
                ]);

                post('pages/ajax/re-order', [
                    'as' => 'admin.pages.re-order',
                    'uses' => 'PageController@reOrder',
                ]);

                post('pages/ajax/toggle-active', [
                    'as' => 'admin.pages.toggle-active',
                    'uses' => 'PageController@toggleActive',
                ]);
            });

            $router->group([
                'namespace' => 'Media',
            ], function () use ($router) {
                get('media/image-inline', [
                    'as' => 'admin.media.image_inline',
                    'uses' => 'MediaController@imageInline',
                ]);

                get('media/doc-inline', [
                    'as' => 'admin.media.doc_inline',
                    'uses' => 'MediaController@docInline',
                ]);

                get('media/images', [
                    'as' => 'admin.media.images',
                    'uses' => 'MediaController@showImages',
                ]);

                get('media/documents', [
                    'as' => 'admin.media.documents',
                    'uses' => 'MediaController@showDocuments',
                ]);

                get('media/all', [
                    'as' => 'admin.media.all',
                    'uses' => 'MediaController@showAll',
                ]);

                delete('media/delete', [
                    'as' => 'admin.media.delete',
                    'uses' => 'MediaController@delete',
                ]);

                post('media/upload', [
                    'as' => 'admin.media.upload',
                    'uses' => 'MediaController@upload',
                ]);

                post('media/update', [
                    'as' => 'admin.media.update',
                    'uses' => 'MediaController@update',
                ]);

                post('media/crop', [
                    'as' => 'admin.media.crop',
                    'uses' => 'MediaController@crop',
                ]);

                get('media/search', [
                    'as' => 'admin.media.search',
                    'uses' => 'MediaController@search',
                ]);

                get('media/json/all', [
                    'as' => 'admin.json.media.all',
                    'uses' => 'MediaController@getAllMedia',
                ]);

                resource('media', 'MediaController');

                resource('presets', 'PresetController');
            });

            $router->group([
                'namespace' => 'Settings',
            ], function () use ($router) {
                resource('settings', 'SettingsController', ['except' => 'show']);

                get('settings/advanced', [
                    'as' => 'admin.settings.advanced.index',
                    'uses' => 'SettingsController@getAdvanced',
                ]);

                post('settings/advanced', [
                    'as' => 'admin.settings.advanced.update',
                    'uses' => 'SettingsController@updateAdvanced',
                ]);
            });

            $router->group([
                'namespace' => 'Company',
            ], function () use ($router) {
                resource('company', 'CompanyController', ['except' => 'show']);
            });

            $router->group([
                'namespace' => 'Users',
            ], function () use ($router) {
                resource('users', 'UsersController');
            });
        });



    }
}
