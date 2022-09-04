<?php

namespace Dicibi\IndoRegion\Tests\Feature;

use Dicibi\IndoRegion\Models\Village;
use function PHPUnit\Framework\assertNotEmpty;

it('can retrieve district', function() {
    /** @var Village $village */
    $village = Village::query()->first();

    assertNotEmpty($village->district);
});