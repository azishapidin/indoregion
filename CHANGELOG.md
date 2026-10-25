# CHANGELOG

## 4.0.0

Changes:

  - Support Laravel 13 and PHP 8.3 - 8.5 (drop support for older versions).
  - Require parsecsv/php-parsecsv ^1.3.
  - Publish migrations as anonymous classes.
  - Add return types to published migrations, seeders and models.
  - Fix malformed rows and stray whitespace in villages.csv.
  - Add integration tests with Orchestra Testbench and GitHub Actions CI.

## 2.0.0

Changes:

  - Add package auto discovery.
  - Remove Package Routes.
  - Move Models namspace from \App\Model to \App\Models.
  - Add Global Seeder for Seeding All Data.