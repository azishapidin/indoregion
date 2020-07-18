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

class PublishCommand extends Command
{

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'indoregion:publish';

    protected $defaultDir = __DIR__."../../";


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
          1.provinces
          2.regencies
          3.districts
          4.villages
          migration will be created in database/migrations directory";

        $message .= "\n\n- A seed that creates :
          1.IndoRegionSeeder
          2.IndoRegionprovinceSeeder
          3.IndoRegionRegencySeeder
          4.IndoRegionDistrictSeeder
          5.IndoRegionVillageSeeder
          seeders will be created in database/seeds";

        $this->comment($message);

        $this->line('');

        if ($this->confirm("Proceed with the seeds, & migration creation? [yes|no]", "yes")) {

            $this->line('');

            $this->info("Publish...");

            $this->publishMigrations();
            $this->comment("Publish migration complete");
            $this->publishSeeds();
            $this->comment("Publish seeder complete");
            
            // $this->publishConfig();
            // $this->comment("Publish config complete");

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
     * Publish migrations.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishDirectory($this->defaultDir.'/database/migrations/' , app()->databasePath("migrations/"));
    }

    /**
     * Publish seeds.
     *
     * @return void
     */
    protected function publishSeeds()
    {
        $this->publishDirectory($this->defaultDir.'/database/seeds/' , app()->databasePath("seeds/"));
    }
}
