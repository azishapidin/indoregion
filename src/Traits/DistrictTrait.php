<?php
/**
 * Created by PhpStorm.
 * User: Cacing
 * Date: 24/08/2019
 * Time: 23:46
 */

namespace AzisHapidin\IndoRegion\Traits;


trait DistrictTrait
{
    /**
     * Check if district is sub province.
     *
     * @param int $id Id of province
     * @return bool
     */
    public function isProvince($id)
    {
        return $this->regency->province_id == $id ? true : false;
    }

    /**
     * Check if district is sub regency.
     *
     * @param int $id Id of regency
     * @return bool
     */
    public function isRegency($id)
    {
        return $this->regency_id == $id ? true : false;
    }

    /**
     * District belongs to Province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->regency->province();
    }
}
