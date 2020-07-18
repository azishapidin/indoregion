<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Ibnul Mutaki < cacing69 | ibnuul@gmail.com>
 *
 */

namespace AzisHapidin\IndoRegion\Facades;
use Illuminate\Support\Facades\Facade;

class IndoRegionFacade extends Facade {
    protected static function getFacadeAccessor(){
        return 'indoregion';
    }
}
