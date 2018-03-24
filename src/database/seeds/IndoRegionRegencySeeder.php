<?php

use Illuminate\Database\Seeder;

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
        $file = file_get_contents(database_path('seeds/data/regencies.txt'));
        $regencies = unserialize($file);
        DB::table('indoregion_regencies')->insert($regencies);
    }
}
