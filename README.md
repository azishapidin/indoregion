# azishapidin/indoregion
[![Build Status](https://travis-ci.org/azishapidin/indoregion.svg?branch=master)](https://travis-ci.org/azishapidin/indoregion) [![StyleCI](https://styleci.io/repos/90970565/shield?branch=master)](https://styleci.io/repos/90970565) [![License](https://poser.pugx.org/azishapidin/indoregion/license)](https://packagist.org/packages/azishapidin/indoregion)

```azishapidin/indoregion``` adalah sebuah package Laravel untuk menyimpan data wilayah Indonesia mulai dari Provinsi, Kabupaten/Kota, Kecamatan/Distrik, sampai Desa/Kelurahan. Package akan menambahkan migrations, seeder (untuk import data ke database) dan Model pada project Anda.

Semua data akan disimpan di database, untuk mengambil data tersebut sama dengan mengambil data lewat Model pada umum-nya (Lihat bagian Usage).

Data ini diambil dari situs Pemutakhiran MFD dan MBS Badan Pusat Statistik (http://mfdonline.bps.go.id/) pada 11 Januari 2018. Sumber: [https://github.com/edwardsamuel/Wilayah-Administratif-Indonesia](https://github.com/edwardsamuel/Wilayah-Administratif-Indonesia)

## Quick Instalation

Buka Command Line kemudian jalankan perintah dibawah untuk melakukan instalasi package:
```
composer require azishapidin/indoregion
```

### Register Service Provider
Jika Anda menggunakan Laravel versi 5.5 keatas Anda bisa skip bagian ini karena package indoregion sudah menggunakan Package Auto Discovery.  
  
Tapi jika kebetulan Project yang Anda kerjakan masih menggunakan versi dibawah 5.5 maka silahkan untuk membuka file **config/app.php** lalu tambahkan Class ```IndoRegionServiceProvider``` kedalam array Service Providers:
```
// Provider Lain
AzisHapidin\IndoRegion\IndoRegionServiceProvider::class,
```

### Publish vendor
Jalankan perintah dibawah di Command Line:
```
php artisan vendor:publish
```
  
Saat perintah diatas dijalankan, maka akan muncul pilihan list providers atau tags yang bisa di-publish. Silahkan pilih ```Provider: AzisHapidin\IndoRegion\IndoRegionServiceProvider``` untuk menyalin beberapa file yang akan kita butuhkan yaitu:

* Files migration dari ```/packages/azishapidin/indoregion/src/database/migrations``` ke ```/database/migrations```
* Files seeder dari ```/packages/azishapidin/indoregion/src/database/seeds``` ke ```/database/seeds```
* Files model dari ```/packages/azishapidin/indoregion/src/database/models``` ke ```/app/Models```

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

## Usage
Anda bisa gunakan class dibawah seperti model pada umum-nya.
  
```
// Get Semua Data
$provinces = \App\Models\Province::all();
$regencies = \App\Models\Regency::all();
$districts = \App\Models\District::all();
$villages = \App\Models\Village::all();

// Get Kabupaten/Kota dari sebuah Provinsi
$regencies = $province->regencies;

// Get Kecamatan dari sebuah Kabupaten/Kota
$districts = $regency->districts;

// Get Desa/Kelurahan dari sebuah Kecamatan
$villages = $district->villages;

```

Untuk lebih jelasnya silahkan diulik ke-empat Model diatas.

## Donasi

[Donasi via Paypal](https://www.paypal.me/azishapidin)