<?php

use Illuminate\Database\Seeder;
use AzisHapidin\IndoRegion\RawDataGetter;

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
        $villages = RawDataGetter::getVillages();
        DB::transaction(function() use($villages) {
            $collection = collect($villages);
            $parts = $collection->chunk(1000);
            foreach ($parts as $subset) {
                DB::table('indoregion_villages')->insert($subset->toArray());
            }
        });
    }
}
