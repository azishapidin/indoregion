<?php

namespace AzisHapidin\IndoRegion;

use Illuminate\Support\ServiceProvider;

/**
 * IndoRegion Service Provider
 */
class IndoRegionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (version_compare(app()->version(), '5.0', '>=')) {
            $this->publishes([
                __DIR__.'/database/migrations/' => database_path('migrations'),
                __DIR__.'/database/seeds/' => database_path('seeds'),
                __DIR__.'/database/model/' => app_path('Model')
            ]);
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
