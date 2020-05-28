<?php
/**
 * This file is part of IndoRegion,
 *
 * @license MIT
 * @package AzisHapidin\IndoRegion
 *
 * (c) Ibnul Mutaki < cacing69 | ibnuul@gmail.com>
 * 
 */

return [

    /*
    |--------------------------------------------------------------------------
    | IndoRegion Model
    |--------------------------------------------------------------------------
    |
    | This is the model used by IndoRegion to create correct relations.  Update
    | the model if it is in a different namespace.
    |
    */
    'models' => [
        'province' => AzisHapidin\IndoRegion\Models\Province::class,
        'regency' => AzisHapidin\IndoRegion\Models\Regency::class,
        'district' => AzisHapidin\IndoRegion\Models\District::class,
        'village' => AzisHapidin\IndoRegion\Models\Village::class,
    ],
    'table' => [
        "province" => "indoregion_provinces",
        "regency" => "indoregion_regencies",
        "district" => "indoregion_districts",
        "village" => "indoregion_villages",
    ]
];