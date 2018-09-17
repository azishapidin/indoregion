<?php

use Illuminate\Database\Seeder;
use AzisHapidin\IndoRegion\RawDataGetter;

class IndoRegionRegencySeeder extends Seeder
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
        $regencies = RawDataGetter::getRegencies();
        DB::table('indoregion_regencies')->insert($regencies);
    }
}
