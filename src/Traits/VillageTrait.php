<?php
/**
 * Created by PhpStorm.
 * User: Cacing
 * Date: 24/08/2019
 * Time: 23:31
 */

namespace AzisHapidin\IndoRegion\Traits;


trait VillageTrait
{
    /**
     * Check if village is sub province.
     *
     * @param int $id Id of province
     * @return bool
     */
    public function isProvince($id)
    {
        return $this->district->regency->province_id == $id ? true : false;
    }

    /**
     * Check if village is sub regency.
     *
     * @param int $id Id of regency
     * @return bool
     */
    public function isRegency($id)
    {
        return $this->district->regency_id == $id ? true : false;
    }

    /**
     * Check if village is sub district.
     *
     * @param int $id Id of district
     * @return bool
     */
    public function isDistrict($id)
    {
        return $this->district_id == $id ? true : false;
    }

    /**
     * Village belongs to Regency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regency()
    {
        return $this->district->regency();
    }

    /**
     * Village belongs to Province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->district->regency->province();
    }
}
