<?php
/*
 * This file is part of the IndoRegion package.
 *
 * (c) Ibnul Mutaki < cacing69 | ibnuul@gmail.com>
 *
 */

namespace AzisHapidin\IndoRegion\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PopulateCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'indoregion:populate {--only=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migration & Seed from IndoRegion';

    /**
     * Seeder map.
     *
     * @var string[]
     */
    protected $mapSeeder = [
        "province" => "IndoRegionProvinceSeeder",
        "regency" => "IndoRegionRegencySeeder",
        "district" => "IndoRegionDistrictSeeder",
        "village" => "IndoRegionVillageSeeder",
    ];

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
     * @throws \Exception
     */
    public function fire()
    {
        $this->validateOnly();

        if ($this->confirm("Proceed tables & rows creation? [yes|no]", "yes")) {

            $this->line('');

            $this->info("migrating files...");
            Artisan::call('migrate');
            $this->line('');
            $this->info("seeding files...");

            if($this->validateOnly()) {
                foreach ($this->getOnlyAsArray() as $k => $v) {
                    $this->info("Seed {$this->getSeeder($v)}");
                    Artisan::call('db:seed', [
                        "--class" => $this->getSeeder($v)
                    ]);
                }
                
                $this->info("Populate complete");
            } else {
                Artisan::call('db:seed', [
                    "--class" => "IndoRegionSeeder"
                ]);

                $this->info("Populate IndoRegion complete");
            }
            
            $this->line('');
        }
    }

    /**
     * Get requested key to be populated.
     *
     * @return false|string[]
     */
    private function getOnlyAsArray()
    {
        return explode(",", $this->option('only'));
    }

    /**
     * Validate that requested key is valid.
     *
     * @return bool
     * @throws \Exception
     */
    private function validateOnly()
    {
        $return = false;

        if(!empty($this->option("only"))) {
            foreach ($this->getOnlyAsArray() as $v) {
                if(!array_key_exists($v, $this->mapSeeder)) {
                    throw new \Exception("parameter not valid, be sure to use : {$this->getValidKeyAsString()}");
                }
            }

            $return = true;
        }

        return $return;
    }

    /**
     * Get valid key for requested key.
     *
     * @return string
     */
    public function getValidKeyAsString()
    {
        return implode(",", array_keys($this->mapSeeder));
    }

    /**
     * Get seeder class.
     *
     * @param $key
     * @return string
     */
    public function getSeeder($key)
    {
        return $this->mapSeeder[$key];
    }
}
