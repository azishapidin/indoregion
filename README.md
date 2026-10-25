# azishapidin/indoregion
[![Tests](https://github.com/azishapidin/indoregion/actions/workflows/tests.yml/badge.svg)](https://github.com/azishapidin/indoregion/actions/workflows/tests.yml) [![StyleCI](https://styleci.io/repos/90970565/shield?branch=master)](https://styleci.io/repos/90970565) [![License](https://poser.pugx.org/azishapidin/indoregion/license)](https://packagist.org/packages/azishapidin/indoregion) [![Latest Stable Version](https://poser.pugx.org/azishapidin/indoregion/v/stable)](https://packagist.org/packages/azishapidin/indoregion) [![Total Downloads](https://poser.pugx.org/azishapidin/indoregion/downloads)](https://packagist.org/packages/azishapidin/indoregion)

`azishapidin/indoregion` adalah package Laravel yang berisi data wilayah administratif Indonesia, mulai dari Provinsi, Kabupaten/Kota, Kecamatan, sampai Desa/Kelurahan. Package ini menambahkan migration, seeder (untuk mengimpor data ke database), dan Model ke project Anda.

Semua data disimpan di database Anda sendiri, sehingga bisa diambil seperti model Eloquent pada umumnya (lihat bagian [Penggunaan Dasar](#penggunaan-dasar)).

## Data

Data mengikuti **Kepmendagri No. 300.2.2-2430 Tahun 2025** tentang Pemberian dan Pemutakhiran Kode dan Data Wilayah Administrasi Pemerintahan dan Pulau, yang diambil dari [cahyadsn/wilayah](https://github.com/cahyadsn/wilayah) (lisensi MIT). Kode wilayah sama dengan yang dipakai di NIK, sehingga 6 digit pertama NIK adalah kode kecamatan.

| Level | Tabel | Jumlah | Format ID | Contoh |
|----|----|----:|----|----|
| Provinsi | `provinces` | 38 | 2 digit | `61` (Kalimantan Barat) |
| Kabupaten/Kota | `regencies` | 514 | 4 digit | `6101` (Kabupaten Sambas) |
| Kecamatan | `districts` | 7.285 | 6 digit | `610105` (Pemangkat) |
| Desa/Kelurahan | `villages` | 83.762 | 10 digit | `6101052001` (Pemangkat Kota) |

Setiap ID diawali ID induknya, misalnya kecamatan `610105` berada di kabupaten `6101`, yang berada di provinsi `61`.

## Versi yang Didukung

| Laravel | Versi IndoRegion | Instalasi |
|----|----|----|
| 11, 12 & 13 | 4.x | `composer require azishapidin/indoregion` |
| 8 | 3.x | `composer require azishapidin/indoregion:^3.0` |
| 6 & 7 | 2.2.2 | `composer require azishapidin/indoregion:2.2.2` |

Versi 4.x membutuhkan PHP 8.2 - 8.5, mengikuti versi PHP yang didukung masing-masing versi Laravel (Laravel 11: PHP 8.2 - 8.4, Laravel 12: PHP 8.2 - 8.5, Laravel 13: PHP 8.3 - 8.5). Database yang diuji: MySQL, PostgreSQL, dan SQLite.

> **Laravel 11** sudah tidak mendapat security patch. Kami sarankan upgrade ke Laravel 12 atau 13.

## Instalasi

### 1. Install Package

```bash
composer require azishapidin/indoregion
```

Service provider terdaftar otomatis lewat Package Auto Discovery.

### 2. Publish File

```bash
php artisan indoregion:publish
```

Perintah di atas menyalin file-file berikut ke project Anda:

| File | Dari | Ke |
|----|----|----|
| Migration | `vendor/azishapidin/indoregion/src/database/migrations` | `database/migrations` |
| Seeder | `vendor/azishapidin/indoregion/src/database/seeders` | `database/seeders` |
| Model | `vendor/azishapidin/indoregion/src/database/models` | `app/Models` |

> File dengan nama yang sama akan ditimpa.

### 3. Migrate dan Seed

```bash
php artisan migrate

# Import semua data, dari Provinsi sampai Desa/Kelurahan
php artisan db:seed --class=IndoRegionSeeder
```

Anda juga bisa mengimpor data per level, dengan urutan dari Provinsi sampai Desa/Kelurahan:

```bash
php artisan db:seed --class=IndoRegionProvinceSeeder   # Provinsi
php artisan db:seed --class=IndoRegionRegencySeeder    # Kabupaten/Kota
php artisan db:seed --class=IndoRegionDistrictSeeder   # Kecamatan
php artisan db:seed --class=IndoRegionVillageSeeder    # Desa/Kelurahan
```

## Struktur Tabel

| Tabel | Kolom |
|----|----|
| `provinces` | `id` char(2) primary key, `name` |
| `regencies` | `id` char(4) primary key, `province_id` char(2), `name` |
| `districts` | `id` char(6) primary key, `regency_id` char(4), `name` |
| `villages` | `id` char(10) primary key, `district_id` char(6), `name` |

Semua ID bertipe string, jadi gunakan string saat mencari data, misalnya `Province::find('61')`, bukan `Province::find(61)`. Nama wilayah disimpan dalam huruf kapital.

## Penggunaan Dasar

Model yang sudah di-publish bisa digunakan seperti model Eloquent pada umumnya.

```php
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;

// Ambil semua provinsi
$provinces = Province::all();

// Cari berdasarkan ID
$province = Province::find('61');

// Cari berdasarkan nama
$province = Province::where('name', 'JAWA BARAT')->first();
$regency = Regency::where('name', 'LIKE', '%CIANJUR%')->first();
$districts = District::where('name', 'LIKE', 'BANDUNG%')->get();
$village = Village::where('name', 'BOJONGHERANG')->first();

// Tabel villages berisi hampir 84 ribu baris,
// gunakan filter atau pagination daripada Village::all()
$villages = Village::where('district_id', '610105')->paginate(20);
```

## Penggunaan Lanjutan

### Relasi

```php
$province = Province::find('61');       // Kalimantan Barat
$regency = Regency::find('6101');       // Kabupaten Sambas
$district = District::find('610105');   // Pemangkat
$village = Village::find('6101052001'); // Pemangkat Kota

// Provinsi
$province->regencies;   // Kabupaten/Kota di provinsi
$province->districts;   // Kecamatan di provinsi

// Kabupaten/Kota
$regency->province;     // Provinsi induk
$regency->districts;    // Kecamatan di kabupaten/kota
$regency->villages;     // Desa/Kelurahan di kabupaten/kota

// Kecamatan
$district->regency;     // Kabupaten/Kota induk
$district->province;    // Provinsi induk
$district->villages;    // Desa/Kelurahan di kecamatan

// Desa/Kelurahan
$village->district;     // Kecamatan induk
$village->regency;      // Kabupaten/Kota induk
$village->province;     // Provinsi induk
```

### Cek Kecamatan di Provinsi

```php
// Logika OR: true jika minimal satu kecamatan ada di provinsi
$province->hasDistrictName(['SELAKAU TIMUR', 'PEMANGKAT', 'SEMPARUK', 'JAWAK']); // true

// Logika AND: true hanya jika semua kecamatan ada di provinsi
$province->hasDistrictName(['SELAKAU TIMUR', 'PEMANGKAT', 'SEMPARUK', 'JAWAK'], true); // false
$province->hasDistrictName(['SELAKAU TIMUR', 'PEMANGKAT', 'SEMPARUK', 'JAWAI'], true); // true

// Berdasarkan ID kecamatan, dengan logika OR atau AND
$province->hasDistrictId(['610103', '610105', '610113', '610119']);       // true
$province->hasDistrictId(['610103', '610105', '610113', '610119'], true); // true
```

### Cek Desa/Kelurahan di Kabupaten/Kota

```php
// Logika OR
$regency->hasVillageName(['PARIT SETIA', 'PELIMPAAN', 'SEMPARUK']);

// Logika AND
$regency->hasVillageName(['PARIT SETIA', 'PELIMPAAN', 'SEMPARUK'], true);

// Berdasarkan ID desa/kelurahan, dengan logika OR atau AND
$regency->hasVillageId(['6101032006', '6101032007', '6101132002']);
$regency->hasVillageId(['6101032006', '6101032007', '6101132002'], true);
```

### Cek Wilayah Induk

```php
// Desa/Kelurahan
$village->isProvince('61');      // true jika desa ada di provinsi 61
$village->isRegency('6101');     // true jika desa ada di kabupaten 6101
$village->isDistrict('610105');  // true jika desa ada di kecamatan 610105

// Kecamatan
$district->isProvince('61');     // true jika kecamatan ada di provinsi 61
$district->isRegency('6101');    // true jika kecamatan ada di kabupaten 6101
```

## Upgrade dari 3.x ke 4.x

Versi 4 membutuhkan Laravel 11 ke atas dan PHP 8.2 ke atas.

> **Penting:** versi 4 menggunakan data dan format kode Kemendagri, menggantikan kode BPS di versi 3. Jika tabel Anda sendiri menyimpan ID wilayah (misalnya `village_id` di tabel `users`), ID tersebut perlu dimigrasikan sebelum Anda mengimpor ulang data:
>
> - Hampir semua ID kecamatan dan desa/kelurahan berubah, contohnya kecamatan `1101010` menjadi `110101`.
> - Ada 4 provinsi baru hasil pemekaran Papua, dan kode provinsi Papua berubah: Papua `94` menjadi `91`, Papua Barat `91` menjadi `92`, dan kode `94` sekarang dipakai Papua Tengah. Kabupaten di wilayah tersebut ikut berpindah kode provinsi.

Struktur tabel juga berubah: kolom `id` sekarang menjadi primary key (sebelumnya hanya index, sehingga migration gagal di PostgreSQL dan MySQL 8.4), dan kolom ID kecamatan berubah dari `char(7)` menjadi `char(6)`. Karena itu tabel wilayah perlu dibuat ulang.

1. Migrasikan atau hapus dulu foreign key dari tabel Anda sendiri yang merujuk ke tabel wilayah. Tabel wilayah tidak bisa dihapus selama masih dirujuk foreign key.

2. Update package:

    ```bash
    composer require azishapidin/indoregion:^4.0
    ```

3. Publish ulang file migration, seeder, dan model:

    ```bash
    php artisan indoregion:publish
    ```

4. Hapus tabel wilayah lama dengan me-rollback 4 migration IndoRegion saja. Migration lain di project Anda tidak ikut di-rollback dan akan ditampilkan sebagai "Migration not found":

    ```bash
    php artisan migrate:reset \
        --path=database/migrations/2017_05_02_140432_create_provinces_tables.php \
        --path=database/migrations/2017_05_02_140444_create_regencies_tables.php \
        --path=database/migrations/2017_05_02_142019_create_districts_tables.php \
        --path=database/migrations/2017_05_02_143454_create_villages_tables.php
    ```

5. Buat ulang tabel dan impor data baru:

    ```bash
    php artisan migrate
    php artisan db:seed --class=IndoRegionSeeder
    ```

## Testing

```bash
composer install
vendor/bin/phpunit
```

## Kontribusi

Kontribusi sangat terbuka. Silakan buat issue atau pull request di [GitHub](https://github.com/azishapidin/indoregion). Untuk perubahan data, pastikan semua test lolos sebelum mengirim pull request.

## Lisensi

Package ini dirilis di bawah [lisensi MIT](LICENSE).
