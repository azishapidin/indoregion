# CHANGELOG

## 4.0.0

Changes:

  - Support Laravel 11, 12 and 13 on PHP 8.2 - 8.5 (drop support for older versions).
  - Require parsecsv/php-parsecsv ^1.3.
  - Make `id` a primary key on all region tables, so migrations work on PostgreSQL and MySQL 8.4.
  - Change district ID columns from char(7) to char(6) to match the 6-digit codes.
  - Index foreign key columns.
  - Publish migrations as anonymous classes.
  - Add return types to published migrations, seeders and models.
  - Published models use string primary keys and disable timestamps, matching the table schema.
  - Rewrite README: data overview, table structure, corrected examples and 3.x to 4.x upgrade guide.
  - Update region data to Kepmendagri No. 300.2.2-2430 Tahun 2025 (38 provinces, 514 regencies, 7,285 districts, 83,762 villages), sourced from cahyadsn/wilayah. Region IDs now follow Kemendagri codes instead of BPS codes.
  - Add integration tests with Orchestra Testbench and GitHub Actions CI (SQLite, MySQL and PostgreSQL).
  - Remove the unused `AzisHapidin\IndoRegion\IndoRegion` class.
  - Exclude development files from the Composer package.

## 2.0.0

Changes:

  - Add package auto discovery.
  - Remove Package Routes.
  - Move Models namspace from \App\Model to \App\Models.
  - Add Global Seeder for Seeding All Data.