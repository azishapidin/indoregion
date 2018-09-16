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
        $data = [];
        $result = self::getCsvData(self::$path . '/provinces.csv');
        foreach ($result as $item) {
            $data[] = [
                'id' => $item[0],
                'name' => $item[1]
            ];
        }

        return $data;
    }

    /**
     * Get regencies data.
     *
     * @return array
     */
    public static function getRegencies()
    {
        $data = [];
        $result = self::getCsvData(self::$path . '/regencies.csv');
        foreach ($result as $item) {
            $data[] = [
                'id' => $item[0],
                'province_id' => $item[1],
                'name' => $item[2],
            ];
        }

        return $data;
    }

    /**
     * Get districts data.
     *
     * @return array
     */
    public static function getDistricts()
    {
        $data = [];
        $result = self::getCsvData(self::$path . '/districts.csv');
        foreach ($result as $item) {
            $data[] = [
                'id' => $item[0],
                'regency_id' => $item[1],
                'name' => $item[2],
            ];
        }

        return $data;
    }

    /**
     * Get villages data.
     *
     * @return array
     */
    public static function getVillages()
    {
        $data = [];
        $result = self::getCsvData(self::$path . '/villages.csv');
        foreach ($result as $item) {
            $data[] = [
                'id' => $item[0],
                'district_id' => $item[1],
                'name' => $item[2],
            ];
        }

        return $data;
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
        $result = [];
        $file = fopen($path, 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            $result[] = $line;
        }
        fclose($file);

        return $result;
    }
}
