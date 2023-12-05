# nurfachmi/indonesia

[![Build Status](https://travis-ci.org/nurfachmi/indonesia.svg?branch=master)](https://travis-ci.org/nurfachmi/indonesia) [![StyleCI](https://styleci.io/repos/90970565/shield?branch=master)](https://styleci.io/repos/90970565) [![License](https://poser.pugx.org/nurfachmi/indonesia/license)](https://packagist.org/packages/nurfachmi/indonesia) [![Latest Stable Version](https://poser.pugx.org/nurfachmi/indonesia/v/stable)](https://packagist.org/packages/nurfachmi/indonesia) [![Total Downloads](https://poser.pugx.org/nurfachmi/indonesia/downloads)](https://packagist.org/packages/nurfachmi/indonesia)

`nurfachmi/indonesia` (fork [azishapidin/indoregion](https://github.com/azishapidin/indoregion)) adalah sebuah package Laravel untuk menyimpan data wilayah Indonesia mulai dari Provinsi, Kabupaten/Kota, Kecamatan/Distrik, sampai Desa/Kelurahan. Package akan menambahkan migrations, seeder (untuk import data ke database) dan Model pada project Anda.

Semua data akan disimpan di database, untuk mengambil data tersebut sama dengan mengambil data lewat Model pada umum-nya (Lihat bagian Usage).

## Quick Instalation

Buka Command Line kemudian jalankan perintah dibawah untuk melakukan instalasi package:

```
composer require nurfachmi/indonesia
```

## Supported Versions

| Laravel Version | Version | Composer Installation                        |
| --------------- | ------- | -------------------------------------------- |
| 10              | 1.0.0   | `composer require nurfachmi/indonesia`       |

### Register Service Provider

#### Laravel

Jika Anda menggunakan Laravel versi 5.5 keatas Anda bisa skip bagian ini karena package indoregion sudah menggunakan Package Auto Discovery.

Tapi jika kebetulan Project yang Anda kerjakan masih menggunakan versi dibawah 5.5 maka silahkan untuk membuka file **config/app.php** lalu tambahkan Class `IndoRegionServiceProvider` kedalam array Service Providers:

```
// Provider Lain
Nurfachmi\Indonesia\IndoRegionServiceProvider::class,
```

#### Lumen

Jika Anda ingin menggunakan Package ini pada project Lumen, maka Anda harus melakukan register Service Provider pada file `bootstrap/app.php` dengan menambahkan ini:

```
$app->register(Nurfachmi\Indonesia\IndoRegionServiceProvider::class);
```

### Publish File

Jalankan perintah dibawah di Command Line:

```
php artisan indoregion:publish
```

Saat perintah diatas dijalankan, indoregion akan menyalin:

- Files migration dari `/vendor/nurfachmi/indonesia/src/database/migrations` ke `/database/migrations`
- Files seeder dari `/vendor/nurfachmi/indonesia/src/database/seeds` ke `/database/seeds`
- Files model dari `/vendor/nurfachmi/indonesia/src/database/models` ke `/app/Models`

Setelah itu jalankan perintah dibawah:

```
composer dump-autoload
```

### Migrate and Seeder

Jalankan perintah dibawah untuk menjalankan migration dan seeder:

```
php artisan migrate

# Import semua data dari Provinsi sampai Kelurahan sekaligus
php artisan db:seed --class=IndoRegionSeeder      # Import data Provinsi, Kota/Kabupaten, Kecamatan/Distrik dan Desa/Kelurahan

# Anda juga bisa melakukan Import data satu per satu, mulai dari Provinsi sampai Kelurahan
php artisan db:seed --class=IndoRegionProvinceSeeder      # Import data provinsi
php artisan db:seed --class=IndoRegionRegencySeeder       # Import data kota/kabupaten
php artisan db:seed --class=IndoRegionDistrictSeeder      # Import data kecamatan/distrik
php artisan db:seed --class=IndoRegionVillageSeeder       # Import data desa/kelurahan
```

## Basic Usage

Anda bisa gunakan class dibawah seperti model pada umum-nya.

```
<?php

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

// Get semua data
$provinces = Province::all();
$regencies = Regency::all();
$districts = District::all();
$villages = Village::all();

// Cari berdasarkan nama
$provinces = Province::where('name', 'JAWA BARAT')->first();
$regencies = Regency::where('name', 'LIKE', '%CIANJUR%')->first();
$districts = District::where('name', 'LIKE', 'BANDUNG%')->get();
$villages = Village::where('name', 'BOJONGHERANG')->first();

```

## Advance Usage

```
<?php

// Get Kecamatan dari sebuah Provinsi.
$districts = $province->districts;

// Cek jika provinsi memiliki kabupaten terkait menggunakan logika OR bedasarkan nama kabupaten.
$province->hasDistrictName(["SELAKAU TIMUR", "PEMANGKAT", "SEMPARUK", "JAWAK"]);

// Cek jika provinsi memiliki kabupaten terkait menggunakan logika AND bedasarkan nama kabupaten.
$province->hasDistrictName(["SELAKAU TIMUR", "PEMANGKAT", "SEMPARUK", "JAWAI"], true);

// Cek jika provinsi memiliki kabupaten terkait menggunakan logika OR bedasarkan id kabupaten.
$province->hasDistrictId([6101, 6102, 6103, 6104]);

// Cek jika provinsi memiliki kabupaten terkait menggunakan logika AND bedasarkan id kabupaten.
$province->hasDistrictId([6101, 6102, 6103, 6104], true);

// Get Kabupaten/Kota dari sebuah Provinsi
$regencies = $province->regencies;

// Get Kecamatan dari sebuah Kabupaten/Kota
$districts = $regency->districts;

// Get Desa/Kelurahan dari sebuah Kabupaten/Kota
$villages = $regency->villages;

// Cek jika kabupaten memiliki desa/kelurahan terkait menggunakan logika AND bedasarkan nama desa/kelurahan.
$regency->hasVillageName(["PARIT SETIA", "PELIMPAAN", "SEMPARUK"], true);

// Cek jika kabupaten memiliki desa/kelurahan terkait menggunakan logika AND bedasarkan id desa/kelurahan.
$regency->hasVillageId([6101050014, 6101040025, 6101060023, 6101020014]);

// Get Desa/Kelurahan dari sebuah Kecamatan
$villages = $district->villages;

// Cek Desa ada di sebuah Provinsi
$village->isProvince(61);

// Cek Desa ada di sebuah Kabupaten
$village->isRegency(6102);

// Cek Desa ada di sebuah Kecamatan
$village->isDistrict(6101050);

// Cek Kecamatan ada di sebuah Provinsi
$district->isProvince(61);

// Cek Kecamatan ada di sebuah Kabupaten
$village->isRegency(6102);

// Get Kabupaten dari sebuah Desa
$village->regency;

// Get Provinsi dari sebuah Desa
$village->province;

// Get Provinsi dari sebuah Kecamatan
$district->province;
```
