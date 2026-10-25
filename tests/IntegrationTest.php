<?php

namespace AzisHapidin\IndoRegion\Tests;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use AzisHapidin\IndoRegion\IndoRegionServiceProvider;
use Database\Seeders\IndoRegionSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;

/**
 * Run the published migrations, seeders and models against a real Laravel app.
 */
class IntegrationTest extends TestCase
{
    /**
     * Package source path.
     *
     * @var string
     */
    protected static $src = __DIR__.'/../src';

    protected function getPackageProviders($app)
    {
        return [IndoRegionServiceProvider::class];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(static::$src.'/database/migrations');
    }

    public static function setUpBeforeClass(): void
    {
        // Models and seeders are stubs meant to be copied into the app,
        // so they are not autoloaded by the package.
        foreach (['models', 'seeders'] as $dir) {
            foreach (glob(static::$src."/database/{$dir}/*.php") as $file) {
                require_once $file;
            }
        }
    }

    /**
     * Test seeding all data and walking the model relations.
     *
     * @return void
     */
    public function testSeedAndRelations()
    {
        $this->seed(IndoRegionSeeder::class);

        $this->assertSame(34, DB::table('provinces')->count());
        $this->assertSame(514, DB::table('regencies')->count());
        $this->assertSame(7230, DB::table('districts')->count());
        $this->assertSame(83449, DB::table('villages')->count());

        $village = Village::find('1101012001');
        $this->assertSame('KEUDE BAKONGAN', $village->name);
        $this->assertSame('BAKONGAN', $village->district->name);
        $this->assertSame('KABUPATEN ACEH SELATAN', $village->district->regency->name);
        $this->assertSame('ACEH', $village->district->regency->province->name);
        $this->assertTrue($village->isProvince('11'));

        $province = Province::find('11');
        $this->assertInstanceOf(Regency::class, $province->regencies->first());
        $this->assertInstanceOf(District::class, $province->districts()->first());
        $this->assertTrue($province->hasDistrictName('BAKONGAN'));
    }

    /**
     * Test the publish command copies every stub into the app.
     *
     * @return void
     */
    public function testPublishCommand()
    {
        $target = sys_get_temp_dir().'/indoregion-'.uniqid();
        $this->app->useAppPath($target.'/app');
        $this->app->useDatabasePath($target.'/database');
        File::makeDirectory($target.'/database/migrations', 0777, true);
        File::makeDirectory($target.'/database/seeders', 0777, true);

        try {
            $this->artisan('indoregion:publish')
                ->expectsOutput('Publishing IndoRegion complete')
                ->assertSuccessful();

            $this->assertCount(4, File::files($target.'/app/Models'));
            $this->assertCount(4, File::files($target.'/database/migrations'));
            $this->assertCount(5, File::files($target.'/database/seeders'));
        } finally {
            File::deleteDirectory($target);
        }
    }
}
