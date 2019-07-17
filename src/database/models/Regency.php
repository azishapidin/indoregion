<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Province;
use App\Models\District;

/**
 * Regency Model.
 */
class Regency extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'indoregion_regencies';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'province_id'
    ];

    /**
     * Regency belongs to Province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Regency has many districts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    /**
     * regency has many villages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function villages()
    {
        return $this->hasManyThrough(Village::class, District::class);
    }

    /**
     * check if regency has villages by name.
     *
     * @param string|array $name villages name or array of villages names.
     * @param bool $requireAll All villages in the array are required.
     *
     * @return bool
     */
    public function hasVillageName($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $villageName) {
                $hasVillage = $this->hasVillageName(strtoupper($villageName));
                if ($hasVillage && !$requireAll) {
                    return true;
                } elseif (!$hasVillage && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the villages were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the villages were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            $getVillageName = array_column($this->villages->toArray(), "name");
            if (in_array(strtoupper($name), $getVillageName)) {
                return true;
            }
        }
        return false;
    }

    /**
     * check if regency has villages by ID.
     *
     * @param string|array $name Villages name or array of villages names.
     * @param bool $requireAll All villages in the array are required.
     *
     * @return bool
     */
    public function hasVillageId($id, $requireAll = false)
    {
        if (is_array($id)) {
            foreach ($id as $villageId) {
                $hasVillage = $this->hasVillageId($villageId);
                if ($hasVillage && !$requireAll) {
                    return true;
                } elseif (!$hasVillage && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the villages were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the villages were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            $getVillageId = array_column($this->villages->toArray(), "id");
            if (in_array(strtoupper($id), $getVillageId)) {
                return true;
            }
        }
        return false;
    }
}
