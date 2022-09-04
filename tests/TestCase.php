<?php

namespace Dicibi\IndoRegion\Tests;

use Dicibi\IndoRegion\Database\Seeders\IndoRegionSeeder;
use Dicibi\IndoRegion\IndoRegionServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    use RefreshDatabase;

    public bool $seed = true;

    public string $seeder = IndoRegionSeeder::class;

    protected function getPackageProviders($app): array
    {
        return [
            IndoRegionServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadLaravelMigrations();
    }
}
