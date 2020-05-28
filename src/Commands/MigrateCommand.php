<?php
/*
 * This file is part of the IndoRegion package.
 *
 * (c) Ibnul Mutaki < cacing69 | ibnuul@gmail.com>
 *
 */

namespace AzisHapidin\IndoRegion\Commands;

use Illuminate\Console\Command;

class MigrateCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'indoregion:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migration from IndoRegion';

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

        $message = "- A migration that creates table :
          1.provinces
          2.regencies
          3.districts
          4.villages";

        $this->comment($message);
        
        $this->line('');

        if ($this->confirm("Proceed with the models, seeds, & migration creation? [yes|no]", "yes")) {

            $this->line('');

            $this->info("Migration IndoRegion complete");

            $this->line('');
        }

        
    }
}
