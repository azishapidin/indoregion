<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace AzisHapidin\IndoRegion;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class IndoRegion
{
    private $province;


    public function __construct()
    {
        $this->province = new Province();
    }

    /**
     * get province instance.
     *
     * @return Province
     */
    public function getAllProvince()
    {
        return $this->province->query()->get();
    }

    /**
     * search province by name.
     *
     * @param String $name String of province
     * @return items of Province 
     */
    public function searchProvinceByName($name = '')
    {
        return $this->province->where("name", "like", "%".$name."%")->get();
    }

    /**
     * find province by id.
     *
     * @param int $id Id of province
     * @return Province 
     */
    public function findProvinceById($id)
    {
        return $this->province->find($id);
    }
}