<?php

use Illuminate\Database\Seeder;

class IndoRegionDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents('data/districts.txt');
        $districts = unserialize($file);
        DB::table('indoregion_districts')->insert($districts);
    }
}
