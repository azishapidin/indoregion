<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Nurfachmi\Indonesia\RawDataGetter;
use Illuminate\Support\Facades\DB;

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
        // Get Data
        $districts = RawDataGetter::getDistricts();

        // Insert Data to Database
        DB::table('districts')->insert($districts);
    }
}
