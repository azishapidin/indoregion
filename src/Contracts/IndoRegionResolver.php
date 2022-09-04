<?php

namespace Dicibi\IndoRegion\Contracts;

use Dicibi\IndoRegion\Models\District;
use Dicibi\IndoRegion\Models\Province;
use Dicibi\IndoRegion\Models\Regency;
use Illuminate\Contracts\Pagination\CursorPaginator;

interface IndoRegionResolver
{
    public function getProvinces(?string $searchQuery = null): CursorPaginator;

    public function getRegencies(Province $province, ?string $searchQuery = null): CursorPaginator;

    public function getDistricts(Regency $regency, ?string $searchQuery = null): CursorPaginator;

    public function getVillages(District $district, ?string $searchQuery = null): CursorPaginator;
}