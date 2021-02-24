<?php
/*
 * This file is part of the IndoRegion package.
 *
 * (c) Ibnul Mutaki <cacing69 | cacingworm@gmail.com>
 *
 */

namespace AzisHapidin\IndoRegion;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class IndoRegionPublishCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'indoregion:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish IndoRegion assets from vendor packages';

    /**
     * Compatiblity for Lumen 5.5.
     *
     * @return void
     */
    public function handle()
    {
        $this->fire();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->publishModels();
        $this->publishMigrations();
        $this->publishSeeds();

        $this->info("Publishing IndoRegion complete");
    }


    /**
     * Publish the directory to the given directory.
     *
     * @param  string  $from
     * @param  string  $to
     * @return void
     */
    protected function publishDirectory($from , $to)
    {
        $exclude = array('..' , '.' , '.DS_Store');
        $source = array_diff(scandir($from) , $exclude);

        foreach ($source as $item) {
            $this->info("Copying file: " . $to . $item);
            File::copy($from . $item , $to . $item);
        }
    }

    /**
     * Publish model.
     *
     * @return void
     */
    protected function publishModels()
    {
        $targetPath = app()->path()."/Models/";

        if (!File::isDirectory($targetPath)){
            File::makeDirectory($targetPath, 0777, true, true);
        }

        $this->publishDirectory(__DIR__.'/database/models/', app()->path()."/Models/");
    }

    /**
     * Publish migrations.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishDirectory(__DIR__.'/database/migrations/', app()->databasePath()."/migrations/");
    }

    /**
     * Publish seeds.
     *
     * @return void
     */
    protected function publishSeeds()
    {
        $this->publishDirectory(__DIR__.'/database/seeders/', app()->databasePath()."/seeders/");
    }
}
