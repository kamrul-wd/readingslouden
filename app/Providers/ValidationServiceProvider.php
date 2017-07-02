<?php

namespace App\Providers;

use App\Http\Validators\PageValidator;
use App\Http\Validators\FileValidator;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    public $validators = [
        FileValidator::class,
        PageValidator::class,
    ];

    /**
     * Bootstrap the application services.
     *
     */
    public function boot()
    {
        foreach ($this->validators as $validator) {
            //$this->app->validator->extend($validator::$name, $validator . '@validate');

            $this->app->validator->resolver(
                function ($translator, $data, $rules, $messages = [], $customAttributes = []) use ($validator) {
                    return new $validator($translator, $data, $rules, $messages, $customAttributes);
                }
            );
        }
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
