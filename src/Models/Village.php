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
 * Village Model.
 *
 * @property  string $name
 * @property  \Dicibi\IndoRegion\Models\District $district
 * @property  int|string $district_id
 * @property  int $id
 */
class Village extends Model
{
    protected $table = 'id_villages';

    public $timestamps = false;

    protected $hidden = [
        'district_id',
    ];

    public function district(): Relations\BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
