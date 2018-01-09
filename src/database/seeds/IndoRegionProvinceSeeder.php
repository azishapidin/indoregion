<?php

use Illuminate\Database\Seeder;

class IndoRegionProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents('data/provinces.txt');
        $provinces = unserialize($file);
        DB::table('indoregion_provinces')->insert($provinces);
    }
}
