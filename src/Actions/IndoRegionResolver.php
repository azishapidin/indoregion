<?php

namespace Dicibi\IndoRegion\Actions;

use Dicibi\IndoRegion\Contracts\IndoRegionResolver as IndoRegionResolverContract;
use Dicibi\IndoRegion\Models\District;
use Dicibi\IndoRegion\Models\Province;
use Dicibi\IndoRegion\Models\Regency;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\CursorPaginator;

class IndoRegionResolver implements IndoRegionResolverContract
{

    public function getProvinces(?string $searchQuery = null): CursorPaginator
    {
        $query = Province::query();

        $query->when(
            $searchQuery,
            static fn (Builder $query, string $input) => $query->where('name', 'like', "%$input%")
        );

        return $query->cursorPaginate();
    }

    public function getRegencies(Province $province, ?string $searchQuery = null): CursorPaginator
    {
        $query = $province->regencies();

        $query->when(
            $searchQuery,
            static fn (Builder $query, string $input) => $query->where('name', 'like', "%$input%")
        );

        return $query->cursorPaginate();
    }

    public function getDistricts(Regency $regency, ?string $searchQuery = null): CursorPaginator
    {
        $query = $regency->districts();

        $query->when(
            $searchQuery,
            static fn (Builder $query, string $input) => $query->where('name', 'like', "%$input%")
        );

        return $query->cursorPaginate();
    }

    public function getVillages(District $district, ?string $searchQuery = null): CursorPaginator
    {
        $query = $district->villages();

        $query->when(
            $searchQuery,
            static fn (Builder $query, string $input) => $query->where('name', 'like', "%$input%")
        );

        return $query->cursorPaginate();
    }
}