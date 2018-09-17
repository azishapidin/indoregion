<?php

namespace AzisHapidin\IndoRegion;

use ParseCsv\Csv;

/**
<<<<<<< HEAD
 * Get raw data from CSV Files on /src/data/csv
=======
 * Get raw data from CSV Files on /src/data/csv.
>>>>>>> 39d711e5e6f5ecf60a02d881f9cd88e5a69eba35
 */
class RawDataGetter
{
    /**
     * Raw Data file path.
     *
     * @return string
     */
<<<<<<< HEAD
    protected static $path = __DIR__ . '/data/csv';
=======
    protected static $path = __DIR__.'/data/csv';
>>>>>>> 39d711e5e6f5ecf60a02d881f9cd88e5a69eba35

    /**
     * Get provinces data.
     *
     * @return array
     */
    public static function getProvinces()
    {
<<<<<<< HEAD
        $result = self::getCsvData(self::$path . '/provinces.csv');
=======
        $result = self::getCsvData(self::$path.'/provinces.csv');
>>>>>>> 39d711e5e6f5ecf60a02d881f9cd88e5a69eba35

        return $result;
    }

    /**
     * Get regencies data.
     *
     * @return array
     */
    public static function getRegencies()
    {
<<<<<<< HEAD
        $result = self::getCsvData(self::$path . '/regencies.csv');
=======
        $result = self::getCsvData(self::$path.'/regencies.csv');
>>>>>>> 39d711e5e6f5ecf60a02d881f9cd88e5a69eba35

        return $result;
    }

    /**
     * Get districts data.
     *
     * @return array
     */
    public static function getDistricts()
    {
<<<<<<< HEAD
        $result = self::getCsvData(self::$path . '/districts.csv');
=======
        $result = self::getCsvData(self::$path.'/districts.csv');
>>>>>>> 39d711e5e6f5ecf60a02d881f9cd88e5a69eba35

        return $result;
    }

    /**
     * Get villages data.
     *
     * @return array
     */
    public static function getVillages()
    {
<<<<<<< HEAD
        $result = self::getCsvData(self::$path . '/villages.csv');
=======
        $result = self::getCsvData(self::$path.'/villages.csv');
>>>>>>> 39d711e5e6f5ecf60a02d881f9cd88e5a69eba35

        return $result;
    }

    /**
     * Get Data from CSV.
     *
     * @param string $path File Path.
     *
     * @return array
     */
    public static function getCsvData($path = '')
    {
        $csv = new Csv($path);

        return $csv->data;
    }
}
