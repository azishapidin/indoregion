<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IndoRegionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(IndoRegionProvinceSeeder::class);
        $this->call(IndoRegionRegencySeeder::class);
        $this->call(IndoRegionDistrictSeeder::class);
        $this->call(IndoRegionVillageSeeder::class);
    }
}