<?php
/*
 * This file is part of the IndoRegion package
 *
 * (c) Azis Hapidin <azishapidin@gmail.com>
 *
 */
use App\Province;
use App\Regency;
use App\District;
use App\Village;

Route::group(['prefix' => 'indoregion'], function () {

    Route::get('/', function(){
        $data['provinces'] = Province::count();
        $data['regencies'] = Regency::count();
        $data['districts'] = District::count();
        $data['villages'] = Village::count();
        return $data;
    });

    Route::get('provinces', function(){
        return Province::all();
    });

    Route::get('regencies', function(){
        return Regency::all();
    });

    Route::get('province/{id}', function($id){
        $province = Province::find($id);
        $data['name'] = $province->name;
        $data['regencies'] = $province->regencies;
        return $data;
    });

    Route::get('regency/{id}', function($id){
        $regency = Regency::find($id);
        $data['name'] = $regency->name;
        $data['districts'] = $regency->districts;
        return $data;
    });

    Route::get('district/{id}', function($id){
        $district = District::find($id);
        $data['name'] = $district->name;
        $data['districts'] = $district->villages;
        return $data;
    });

});
