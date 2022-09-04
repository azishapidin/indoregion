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
 * District Model.
 *
 * @property  string $name
 * @property  Regency $regency
 * @property  \Illuminate\Database\Eloquent\Collection<int, \Dicibi\IndoRegion\Models\Village> $villages
 * @property  int|string $regency_id
 */
class District extends Model
{
    protected $table = 'id_districts';

    public $timestamps = false;

    protected $hidden = [
        'regency_id',
    ];

    public function regency(): Relations\BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    public function villages(): Relations\HasMany
    {
        return $this->hasMany(Village::class);
    }
}
