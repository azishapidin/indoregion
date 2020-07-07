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

class PupolateCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'indoregion:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migration & Seed from IndoRegion';

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

        if ($this->confirm("Proceed tables & rows creation? [yes|no]", "yes")) {

            $this->line('');

            $this->info("migrating files...");
            Artisan::call('migrate');
            $this->line('');
            $this->info("seeding files...");
            Artisan::call('db:seed', [
                "--class" => "IndoRegionSeeder"
            ]);
            $this->line('');
            $this->info("Pupolate IndoRegion complete");

            $this->line('');
        }

        
    }
}
