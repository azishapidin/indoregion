<?php
/*
 * This file is part of the IndoRegion package.
 *
 * (c) Ibnul Mutaki < cacing69 | ibnuul@gmail.com>
 *
 */

namespace AzisHapidin\IndoRegion\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use AzisHapidin\IndoRegion\Traits\IndoRegionDirectoryTrait;

class PublishCommand extends Command
{
    use IndoRegionDirectoryTrait;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'indoregion:publish';

    protected $defaultDir = __DIR__."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;


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
        $message = "- A migration that creates :
        \t1.provinces
        \t2.regencies
        \t3.districts
        \t4.villages
        \tmigration will be created in database/migrations directory";

        $message .= "\n\n- A model that creates :
        \t1.Province
        \t2.Regency
        \t3.District
        \t4.Village
        \tmodels will be created in app\Models directory";

        $message .= "\n\n- A seed that creates :
        \t1.IndoRegionSeeder
        \t2.IndoRegionprovinceSeeder
        \t3.IndoRegionRegencySeeder
        \t4.IndoRegionDistrictSeeder
        \t5.IndoRegionVillageSeeder
        \tseeders will be created in database/seeds";

        $this->comment($message);

        $this->line('');

        if ($this->confirm("Proceed with the models, seeds, & migration creation? [yes|no]", "yes")) {

            $this->line('');

            $this->info("Publish files...");
            
            $this->publishModels();
            $this->comment("Publish model complete");
            $this->publishMigrations();
            $this->comment("Publish migration complete");
            $this->publishSeeds();
            $this->comment("Publish seeder complete");

            $this->info("Publishing IndoRegion complete");

            $this->line('');
        }
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
        $targetPath = $this->getDirModelTarget() ;

        if (!File::isDirectory($targetPath)){
            File::makeDirectory($targetPath, 0777, true, true);
        }

        $this->publishDirectory($this->getDirModelDefault($this->defaultDir) , $targetPath);
    }

    /**
     * Publish migrations.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishDirectory($this->getDirMigrationDefault($this->defaultDir) , $this->getDirMigrationTarget());
    }

    /**
     * Publish seeds.
     *
     * @return void
     */
    protected function publishSeeds()
    {
        $this->publishDirectory($this->getDirSeedDefault($this->defaultDir) , $this->getDirSeedTarget());
    }
}
