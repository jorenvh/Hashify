<?php

namespace JorenVanHocht\Hash\Providers;

use Illuminate\Support\ServiceProvider;
use JorenVanHocht\Hash\Hash;

class HashServiceProvider extends ServiceProvider
{
    /**
     * Register the class.
     *
     */
    public function register()
    {
        $this->app->bind('jorenvanhocht.hash', function() {
            return new Hash($this->app['db'], $this->app['config']);
        });
    }

    /**
     * Load the resources.
     *
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/hash.php', 'hash');
    }
}