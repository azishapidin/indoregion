<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Nurfachmi\Indonesia\RawDataGetter;
use Illuminate\Support\Facades\DB;

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
        DB::table('regencies')->insert($regencies);
    }
}
