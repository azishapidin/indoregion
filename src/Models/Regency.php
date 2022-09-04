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
 * Regency Model.
 *
 * @property  string $name
 * @property  \Dicibi\IndoRegion\Models\Province $province
 * @property  \Illuminate\Database\Eloquent\Collection<int, \Dicibi\IndoRegion\Models\District> $districts
 * @property  \Illuminate\Database\Eloquent\Collection<int, \Dicibi\IndoRegion\Models\District> $villages
 * @property  int $province_id
 * @property  int $id
 */
class Regency extends Model
{
    protected $table = 'id_regencies';

    public $timestamps = false;

    protected $hidden = [
        'province_id',
    ];

    public function province(): Relations\BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function districts(): Relations\HasMany
    {
        return $this->hasMany(District::class, 'regency_id');
    }

    public function villages(): Relations\HasManyThrough
    {
        return $this->hasManyThrough(Village::class, District::class);
    }
}
