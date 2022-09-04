<?php

namespace Dicibi\IndoRegion\Tests\Feature;

use Dicibi\IndoRegion\Contracts\IndoRegionResolver;
use Dicibi\IndoRegion\Models\Province;
use Illuminate\Pagination\CursorPaginator;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\assertNotSame;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

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

    assertSame($province->id, (int) $regency->province_id);
});

it('can retrieve district from province', function () {
    /** @var Province $province */
    $province = Province::query()->whereHas('districts')->first();

    assertNotEmpty($province->districts()->count());

    /** @var \Dicibi\IndoRegion\Models\District $district */
    $district = $province->districts()->first();

    assertTrue($province->regencies()->where('id', $district->regency_id)->exists());
});

it('can retrieve provinces from action', function () {
    /** @var IndoRegionResolver $action */
    $action = app()->get(IndoRegionResolver::class);

    $pagination = $action->getProvinces();

    assertInstanceOf(CursorPaginator::class, $pagination);

    $pagination = $action->getProvinces('Jawa');

    assertCount(3, $pagination->items());
});
