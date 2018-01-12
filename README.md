# azishapidin/indoregion
[![Build Status](https://travis-ci.org/azishapidin/indoregion.svg?branch=master)](https://travis-ci.org/azishapidin/indoregion) [![StyleCI](https://styleci.io/repos/90970565/shield?branch=master)](https://styleci.io/repos/90970565) [![Latest Stable Version](https://poser.pugx.org/azishapidin/indoregion/v/stable)](https://packagist.org/packages/azishapidin/indoregion) [![License](https://poser.pugx.org/azishapidin/indoregion/license)](https://packagist.org/packages/azishapidin/indoregion)

## Quick Instalation

Buka Command Line kemudian jalankan perintah dibawah untuk melakukan instalasi package:
```
composer require azishapidin/indoregion
```
Setelah itu jalankan perintah dibawah juga:
```
composer dump-autoload
```

### Register Service Provider
Buka file **config/app.php** lalu tambahkan Class IndoRegionServiceProvider kedalam array Service Providers:
```
// Provider Lain
AzisHapidin\IndoRegion\IndoRegionServiceProvider::class,
```

### Publish vendor
Jalankan perintah dibawah di Command Line:
```
php artisan vendor:publish
```
Perintah diatas akan menyalin beberapa direktori:
* File migration dari [/packages/azishapidin/indoregion/src/database/migrations] ke [/database/migrations]
* File seeder dari [/packages/azishapidin/indoregion/src/database/seeds] ke [/database/seeds]
* File model dari [/packages/azishapidin/indoregion/src/database/model] ke [/app/Model]

### Migrate and Seeder
Selanjutnya jalankan perintah dibawah untuk menjalankan migration dan seeder:
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
