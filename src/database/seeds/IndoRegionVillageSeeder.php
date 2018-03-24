<?php

use Illuminate\Database\Seeder;

class IndoRegionVillageSeeder extends Seeder
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
        $file = file_get_contents(database_path('seeds/data/villages.txt'));
        $villages = unserialize($file);
        foreach ($villages as $village) {
            DB::table('indoregion_villages')->insert($village);
        }
    }
}
