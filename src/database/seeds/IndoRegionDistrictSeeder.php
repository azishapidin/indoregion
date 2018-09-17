<?php

use Illuminate\Database\Seeder;
use AzisHapidin\IndoRegion\RawDataGetter;

class IndoRegionDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @deprecated
     * 
     * @return void
     */
    public function run()
    {
        $districts = RawDataGetter::getDistricts();
        DB::table('indoregion_districts')->insert($districts);
    }
}
