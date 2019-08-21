<?php
/**
 * Created by PhpStorm.
 * User: Cacing
 * Date: 18/07/2019
 * Time: 0:47
 */

namespace AzisHapidin\IndoRegion\Traits;


use App\Models\District;
use App\Models\Village;

trait RegencyTrait
{
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
