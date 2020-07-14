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
use AzisHapidin\IndoRegion\Commands\PopulateCommand;

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
        // Publish config files
        $this->publishes([
            __DIR__.'/config/config.php' => app()->basePath() . '/config/indoregion.php',
        ]);

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Register commands
        $this->commands('command.indoregion.publish');
        $this->commands('command.indoregion.populate');
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerIndoRegion()
    {
        $this->app->bind('indoregion', function(){
            return new IndoRegion();
        });

        $this->app->alias('indoregion', AzisHapidin\IndoRegion\IndoRegion::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerIndoRegion();

        $this->registerCommands();
        
        $this->mergeConfig();
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->singleton('command.indoregion.publish', function ($app) {
            return new PublishCommand();
        });

        $this->app->singleton('command.indoregion.populate', function ($app) {
            return new PopulateCommand();
        });
    }

    /**
     * Merges user's and entrust's configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'indoregion'
        );
    }

    public function provides()
    {
        return [
            'command.indoregion.publish',
            'command.indoregion.populate',
        ];
    }
}
