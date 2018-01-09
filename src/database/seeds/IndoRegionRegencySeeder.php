<?php

use Illuminate\Database\Seeder;

class IndoRegionRegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents('data/regencies.txt');
        $regencies = unserialize($file);
        DB::table('indoregion_regencies')->insert($regencies);
    }
}
