<?php

namespace Dicibi\IndoRegion\Tests\Feature;

use Dicibi\IndoRegion\Models\Regency;
use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

it('can retrieve province', function () {
    /** @var Regency $regency */
    $regency = Regency::query()->first();

    assertNotEmpty($regency->province);
});

it('can retrieve districts', function () {
    /** @var Regency $regency */
    $regency = Regency::query()->whereHas('districts')->first();

    assertNotEmpty($regency);

    /** @var \Dicibi\IndoRegion\Models\District $district */
    $district = $regency->districts()->first();

    assertSame((int) $district->regency_id, $regency->id);
});

it('can retrieve villages', function () {
    /** @var Regency $regency */
    $regency = Regency::query()->whereHas('villages')->first();

    assertNotEmpty($regency);

    /** @var \Dicibi\IndoRegion\Models\Village $village */
    $village = $regency->villages()->first();

    assertTrue($regency->districts()->where('id', $village->district_id)->exists());
});
