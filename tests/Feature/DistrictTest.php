<?php

namespace Dicibi\IndoRegion\Tests\Feature;

use Dicibi\IndoRegion\Models\District;
use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\assertTrue;

it('can retrieve regency', function () {
    /** @var District $district */
    $district = District::query()->first();

    assertNotEmpty($district->regency);
});

it('can retrieve villages', function () {
    /** @var District $district */
    $district = District::query()->whereHas('villages')->first();

    assertNotEmpty($district);
});

it('can retrieve villages with same value with regency', function () {
    /** @var District $district */
    $district = District::query()->whereHas('villages')->first();

    /** @var \Dicibi\IndoRegion\Models\Village $village */
    $village = $district->villages()->first();

    assertTrue($district->regency->villages()->where('id_villages.id', $village->id)->exists());
});
