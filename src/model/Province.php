<?php

/*
 * This file is part of the IndoRegion package
 *
 * (c) Azis Hapidin <azishapidin@gmail.com>
 *
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Regency;

class Province extends Model
{
    protected $table = 'indoregion_provinces';

    public function regencies()
    {
        return $this->hasMany(Regency::class);
    }
}
