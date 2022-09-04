<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Dicibi\IndoRegion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

/**
 * Province Model.
 *
 * @property  string $name
 * @property  \Illuminate\Database\Eloquent\Collection<int, \Dicibi\IndoRegion\Models\Regency> $regencies
 * @property  \Illuminate\Database\Eloquent\Collection<int, \Dicibi\IndoRegion\Models\District> $districts
 * @property  int $id
 */
class Province extends Model
{
    protected $table = 'id_provinces';

    public $timestamps = false;

    public function regencies(): Relations\HasMany
    {
        return $this->hasMany(Regency::class, 'province_id', 'id');
    }

    public function districts(): Relations\HasManyThrough
    {
        return $this->hasManyThrough(District::class, Regency::class);
    }
}
