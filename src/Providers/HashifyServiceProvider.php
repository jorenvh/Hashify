<?php

namespace jorenvanhocht\Hashify\Providers;

use Illuminate\Support\ServiceProvider;
use jorenvanhocht\Hashify\Hashify;

class HashifyServiceProvider extends ServiceProvider
{
    /**
     * Register the class.
     *
     */
    public function register()
    {
        $this->app->bind('jorenvanhocht.hashify', function() {
            return new Hashify($this->app['db'], $this->app['config']);
        });
    }

    /**
     * Load the resources.
     *
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/hashify.php', 'hashify');

        $this->publishes([
            __DIR__.'/../../config/hashify.php' => config_path(),
        ], 'config');
    }
}