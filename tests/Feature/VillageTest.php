<?php

namespace Dicibi\IndoRegion\Tests\Feature;

use Dicibi\IndoRegion\Contracts\IndoRegionResolver;
use Dicibi\IndoRegion\Models\District;
use Dicibi\IndoRegion\Models\Village;
use Illuminate\Pagination\CursorPaginator;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNotEmpty;

it('can retrieve villages', function () {
    /** @var Village $village */
    $village = Village::query()->first();

    assertNotEmpty($village->district);
});

it('can retrieve village from actions', function () {
    // rungkut
    /** @var \Dicibi\IndoRegion\Models\District $district */
    $district = District::query()->find(357803);

    /** @var IndoRegionResolver $action */
    $action = app()->get(IndoRegionResolver::class);

    $pagination = $action->getVillages($district);

    assertInstanceOf(CursorPaginator::class, $pagination);

    $pagination = $action->getVillages($district, 'Penjaringan Sari');

    assertCount(1, $pagination->items());
});
