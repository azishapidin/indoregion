<?php

namespace Dicibi\IndoRegion\Tests\Feature;

use Dicibi\IndoRegion\Models\Province;
use function PHPUnit\Framework\{assertNotEmpty, assertNotSame, assertSame, assertTrue};

it('can retrieve provinces', function () {
    $provinceQuery = Province::query();

    assertNotSame(0, $provinceQuery->count());
});

it('can retrieve regencies from province', function () {
    /** @var Province $province */
    $province = Province::query()->whereHas('regencies')->first();

    assertNotEmpty($province->regencies()->count());

    /** @var \Dicibi\IndoRegion\Models\Regency $regency */
    $regency = $province->regencies()->first();

    assertSame($province->id, $regency->province_id);
});

it('can retrieve district from province', function () {
    /** @var Province $province */
    $province = Province::query()->whereHas('districts')->first();

    assertNotEmpty($province->districts()->count());

    /** @var \Dicibi\IndoRegion\Models\District $district */
    $district = $province->districts()->first();

    assertTrue($province->regencies()->where('id', $district->regency_id)->exists());
});