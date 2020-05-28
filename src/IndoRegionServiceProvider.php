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
        // Publish config files
        $this->publishes([
            __DIR__.'/config/config.php' => app()->basePath() . '/config/indoregion.php',
        ]);

        // Register commands
        $this->commands('command.indoregion.publish');
        $this->commands('command.indoregion.migrate');
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

        $this->app->singleton('command.indoregion.migrate', function ($app) {
            return new MigrateCommand();
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
            'command.indoregion.migrate',
            // 'command.indoregion.seed',
        ];
    }
}
