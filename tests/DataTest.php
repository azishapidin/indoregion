<?php

use PHPUnit\Framework\TestCase;

/**
 * Data Test
 */
class DataTest extends TestCase
{
    /**
     * Test Provinces Data
     *
     * @return void
     */
    public function testProvincesData()
    {
        $file = file_get_contents('src/database/seeds/data/provinces.txt');
        $provinces = unserialize($file);
        $this->assertTrue(is_array($provinces));
        $this->assertTrue(count($provinces) > 0);
    }

    /**
     * Test Regencies Data
     *
     * @return void
     */
    public function testRegenciesData()
    {
        $file = file_get_contents('src/database/seeds/data/regencies.txt');
        $regencies = unserialize($file);
        $this->assertTrue(is_array($regencies));
        $this->assertTrue(count($regencies) > 0);
    }

    /**
     * Test Districts Data
     *
     * @return void
     */
    public function testDistrictsData()
    {
        $file = file_get_contents('src/database/seeds/data/districts.txt');
        $districts = unserialize($file);
        $this->assertTrue(is_array($districts));
        $this->assertTrue(count($districts) > 0);
    }

    /**
     * Test Villages Data
     *
     * @return void
     */
    public function testVillagesData()
    {
        $file = file_get_contents('src/database/seeds/data/villages.txt');
        $villages = unserialize($file);
        $this->assertTrue(is_array($villages));
        $this->assertTrue(count($villages) > 0);
    }
}