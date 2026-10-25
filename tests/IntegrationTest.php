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

        $this->assertSame(38, DB::table('provinces')->count());
        $this->assertSame(514, DB::table('regencies')->count());
        $this->assertSame(7285, DB::table('districts')->count());
        $this->assertSame(83762, DB::table('villages')->count());

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
     * Test the examples shown in README.md.
     *
     * @return void
     */
    public function testReadmeExamples()
    {
        $this->seed(IndoRegionSeeder::class);

        $province = Province::find('61');
        $regency = Regency::find('6101');
        $district = District::find('610105');
        $village = Village::find('6101052001');

        $this->assertSame('KALIMANTAN BARAT', $province->name);
        $this->assertSame('KABUPATEN SAMBAS', $regency->name);
        $this->assertSame('PEMANGKAT', $district->name);
        $this->assertSame('PEMANGKAT KOTA', $village->name);

        $this->assertNotNull(Province::where('name', 'JAWA BARAT')->first());
        $this->assertNotNull(Regency::where('name', 'LIKE', '%CIANJUR%')->first());
        $this->assertNotEmpty(District::where('name', 'LIKE', 'BANDUNG%')->get());
        $this->assertNotNull(Village::where('name', 'BOJONGHERANG')->first());
        $this->assertSame(8, Village::where('district_id', '610105')->paginate(20)->total());

        $this->assertNotEmpty($province->regencies);
        $this->assertNotEmpty($province->districts);
        $this->assertSame('61', $regency->province->id);
        $this->assertNotEmpty($regency->districts);
        $this->assertNotEmpty($regency->villages);
        $this->assertSame('6101', $district->regency->id);
        $this->assertSame('61', $district->province->id);
        $this->assertNotEmpty($district->villages);
        $this->assertSame('610105', $village->district->id);
        $this->assertSame('610105', $village->district_id);
        $this->assertSame('6101', $village->regency->id);
        $this->assertSame('61', $village->province->id);

        $this->assertTrue($province->hasDistrictName(['SELAKAU TIMUR', 'PEMANGKAT', 'SEMPARUK', 'JAWAK']));
        $this->assertFalse($province->hasDistrictName(['SELAKAU TIMUR', 'PEMANGKAT', 'SEMPARUK', 'JAWAK'], true));
        $this->assertTrue($province->hasDistrictName(['SELAKAU TIMUR', 'PEMANGKAT', 'SEMPARUK', 'JAWAI'], true));
        $this->assertTrue($province->hasDistrictId(['610103', '610105', '610113', '610119']));
        $this->assertTrue($province->hasDistrictId(['610103', '610105', '610113', '610119'], true));

        $this->assertTrue($regency->hasVillageName(['PARIT SETIA', 'PELIMPAAN', 'SEMPARUK']));
        $this->assertTrue($regency->hasVillageName(['PARIT SETIA', 'PELIMPAAN', 'SEMPARUK'], true));
        $this->assertTrue($regency->hasVillageId(['6101032006', '6101032007', '6101132002']));
        $this->assertTrue($regency->hasVillageId(['6101032006', '6101032007', '6101132002'], true));

        $this->assertTrue($village->isProvince('61'));
        $this->assertTrue($village->isRegency('6101'));
        $this->assertTrue($village->isDistrict('610105'));
        $this->assertTrue($district->isProvince('61'));
        $this->assertTrue($district->isRegency('6101'));
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
