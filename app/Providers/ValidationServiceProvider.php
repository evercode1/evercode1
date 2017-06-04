<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('isValidCategory', function ($attribute, $value, $parameters)
        {

            $verified = Category::where('id', $value)->exists();

            return 'isValidCategory' == $verified;

        },
            'Sorry, category is blank or is not a valid category!');
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
