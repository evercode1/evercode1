<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\ContactTopic;

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

        $this->app['validator']->extend('isValidTopic', function ($attribute, $value, $parameters)
        {

            $verified = ContactTopic::where('id', $value)->exists();

            return 'isValidTopic' == $verified;

        },
            'Sorry, topic is blank or is not a valid topic!');
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
