# azishapidin/indoregion
[![Build Status](https://travis-ci.org/azishapidin/indoregion.svg?branch=master)](https://travis-ci.org/azishapidin/indoregion) [![StyleCI](https://styleci.io/repos/90970565/shield?branch=master)](https://styleci.io/repos/90970565) [![Latest Stable Version](https://poser.pugx.org/azishapidin/indoregion/v/stable)](https://packagist.org/packages/azishapidin/indoregion) [![License](https://poser.pugx.org/azishapidin/indoregion/license)](https://packagist.org/packages/azishapidin/indoregion)

## Quick Instalation


```
composer require azishapidin/indoregion
```
Next run this command on main Laravel Project:
```
composer dump-autoload
```

### Register Service Provider
Open **config/app.php** and add IndoRegion Service Provider to the Array of Service Providers:
```
// Other providers
AzisHapidin\IndoRegion\IndoRegionServiceProvider::class,
```

### Publish vendor
Go to Command Line and run this command:
```
php artisan vendor:publish
```
This command will copy these directories to our Project:
* Migration files from [/packages/azishapidin/indoregion/src/database/migrations] To [/database/migrations]
* Seeder files from [/packages/azishapidin/indoregion/src/database/seeds] To [/database/seeds]
* Model files [/packages/azishapidin/indoregion/src/database/model] To [/app/Model]

### Running Migration and Seeder
Now, we must running migrations for create table in our database and run Seeder for fill it. Just run these in Command Line:
```
php artisan migrate
php artisan db:seed --class=IndoRegionProvinceSeeder
php artisan db:seed --class=IndoRegionRegencySeeder
php artisan db:seed --class=IndoRegionDistrictSeeder
php artisan db:seed --class=IndoRegionVillageSeeder
```

## Usage
```
$provinces = \App\Province::all();
$regencies = \App\Regency::all();
$districts = \App\District::all();
$villages = \App\Village::all();
```