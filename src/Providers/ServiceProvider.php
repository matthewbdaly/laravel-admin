<?php

namespace Matthewbdaly\LaravelAdmin\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Service provider
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../views', 'admin');
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->publishes([
            __DIR__.'/../views', resource_path('views/admin')
        ]);
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
