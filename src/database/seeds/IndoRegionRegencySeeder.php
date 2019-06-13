<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

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
        // Get Data
        $regencies = RawDataGetter::getRegencies();

        // Insert Data to Database
        DB::table('indoregion_regencies')->insert($regencies);
    }
}
