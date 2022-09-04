<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Dicibi\IndoRegion\Database\Seeders;

use Dicibi\IndoRegion\Models\Regency;
use Dicibi\IndoRegion\RawDataGetter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndoRegionRegencySeeder extends Seeder
{
    /**
     * @throws \League\Csv\Exception
     */
    public function run(): void
    {
        // Get Data
        $regencies = RawDataGetter::getRegencies();

        // Insert Data to Database
        foreach ($regencies as $regency) {
            Regency::query()->create($regency);
        }
    }
}
