<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Dicibi\IndoRegion\Database\Seeders;

use Dicibi\IndoRegion\Models\Village;
use Dicibi\IndoRegion\RawDataGetter;
use Illuminate\Database\Seeder;

class IndoRegionVillageSeeder extends Seeder
{
    /**
     * @throws \League\Csv\Exception
     */
    public function run(): void
    {
        // Get Data
        $villages = RawDataGetter::getVillages();

        // Insert Data with Chunk
        collect($villages)->chunk(100)->each(function ($chunk) {
            Village::query()->insert($chunk->toArray());
        });
    }
}
