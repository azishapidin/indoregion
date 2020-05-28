<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace AzisHapidin\IndoRegion;

use Illuminate\Support\ServiceProvider;
use AzisHapidin\IndoRegion\IndoRegion;
use AzisHapidin\IndoRegion\Commands\PublishCommand;
use AzisHapidin\IndoRegion\Commands\MigrateCommand;

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
        if ($this->app->runningInConsole()) {
            $this->commands([
                PublishCommand::class,
                MigrateCommand::class,
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
        $this->app->bind('indoregion', function(){
            return new IndoRegion();
        });
    }
}
