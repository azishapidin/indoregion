<?php

/*
 * This file is part of the IndoRegion package
 *
 * (c) Azis Hapidin <azishapidin@gmail.com>
 *
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\District;

/**
 * Village Model.
 */
class Village extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'indoregion_villages';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['district_id'];
	
	/**
     * Village belongs to District.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
