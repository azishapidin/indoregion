<?php

/*
 * This file is part of the IndoRegion package
 *
 * (c) Azis Hapidin <azishapidin@gmail.com>
 *
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\District;

class Village extends Model
{
  protected $table = 'indoregion_villages';
  protected $hidden = ['district_id'];

  public function district()
  {
      return $this->belongsTo(District::class);
  }
}
