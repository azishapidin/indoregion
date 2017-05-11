<?php

/*
 * This file is part of the IndoRegion package
 *
 * (c) Azis Hapidin <azishapidin@gmail.com>
 *
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Regency;

class Province extends Model
{
    protected $table = 'indoregion_provinces';
    public function regencies(){
        return $this->hasMany(Regency::class);
    }
}
