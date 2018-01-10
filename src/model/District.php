<?php

/*
 * This file is part of the IndoRegion package
 *
 * (c) Azis Hapidin <azishapidin@gmail.com>
 *
 */

namespace AzisHapidin\IndoRegion;

use Illuminate\Database\Eloquent\Model;
use App\Regency;
use App\Village;

class District extends Model
{
    protected $table = 'indoregion_districts';
    protected $hidden = ['regency_id'];

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
