<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Regency;

/**
 * Province Model.
 */
class Province extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'indoregion_provinces';

    /**
     * Province has many regencies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regencies()
    {
        return $this->hasMany(Regency::class);
    }


    /**
     * Province has many districts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function districts()
    {
        return $this->hasManyThrough(District::class, Regency::class);
    }

    /**
     * check if province has districts by name.
     *
     * @param string|array $name District name or array of district names.
     * @param bool $requireAll All district in the array are required.
     *
     * @return bool
     */
    public function hasDistrictName($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $districtName) {
                $hasDistrict = $this->hasDistrictName(strtoupper($districtName));
                if ($hasDistrict && !$requireAll) {
                    return true;
                } elseif (!$hasDistrict && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the districts were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the districts were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            $getDistrictName = array_column($this->districts->toArray(), "name");
            if (in_array(strtoupper($name), $getDistrictName)) {
                return true;
            }
        }
        return false;
    }

    /**
     * check if province has districts by ID.
     *
     * @param string|array $name District name or array of district names.
     * @param bool $requireAll All district in the array are required.
     *
     * @return bool
     */
    public function hasDistrictId($id, $requireAll = false)
    {
        if (is_array($id)) {
            foreach ($id as $districtId) {
                $hasDistrict = $this->hasDistrictId($districtId);
                if ($hasDistrict && !$requireAll) {
                    return true;
                } elseif (!$hasDistrict && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the districts were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the districts were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            $getDistrictId = array_column($this->districts->toArray(), "id");
            if (in_array(strtoupper($id), $getDistrictId)) {
                return true;
            }
        }
        return false;
    }
}
