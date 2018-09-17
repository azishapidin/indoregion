<?php

/*
 * This file is part of the IndoRegion package
 *
 * (c) Azis Hapidin <azishapidin@gmail.com>
 *
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Province;
use App\Model\District;

class Regency extends Model
{
    protected $table = 'indoregion_regencies';
    protected $hidden = ['province_id'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
