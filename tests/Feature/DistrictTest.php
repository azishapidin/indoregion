<?php

namespace Dicibi\IndoRegion\Tests\Feature;

use Dicibi\IndoRegion\Contracts\IndoRegionResolver;
use Dicibi\IndoRegion\Models\District;
use Dicibi\IndoRegion\Models\Regency;
use Illuminate\Pagination\CursorPaginator;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertInstanceOf;
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

it('can retrieve district from actions', function () {
    // surabaya
    /** @var \Dicibi\IndoRegion\Models\Regency $regency */
    $regency = Regency::query()->find(3578);

    /** @var IndoRegionResolver $action */
    $action = app()->get(IndoRegionResolver::class);

    $pagination = $action->getDistricts($regency);

    assertInstanceOf(CursorPaginator::class, $pagination);

    $pagination = $action->getDistricts($regency, 'Rungkut');

    assertCount(1, $pagination->items());
});
