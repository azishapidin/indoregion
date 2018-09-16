<?php

namespace AzisHapidin\IndoRegion;

use ParseCsv\Csv;

/**
 * Get raw data from CSV Files on /src/data/csv
 */
class RawDataGetter
{
    /**
     * Raw Data file path.
     *
     * @return string
     */
    protected static $path = __DIR__ . '/data/csv';

    /**
     * Get provinces data.
     *
     * @return array
     */
    public static function getProvinces()
    {
        $result = new Csv(self::$path . '/provinces.csv');

        return $result->data;
    }

    /**
     * Get regencies data.
     *
     * @return array
     */
    public static function getRegencies()
    {
        $result = new Csv(self::$path . '/regencies.csv');

        return $result->data;
    }

    /**
     * Get districts data.
     *
     * @return array
     */
    public static function getDistricts()
    {
        $result = new Csv(self::$path . '/districts.csv');

        return $result->data;
    }

    /**
     * Get villages data.
     *
     * @return array
     */
    public static function getVillages()
    {
        $result = new Csv(self::$path . '/villages.csv');

        return $result->data;
    }
}
