# Dokumentasi Testing

Testing memakai [Codeception](https://codeception.com/) 4 dengan modul Yii2.
Konfigurasi utama ada di [`codeception.yml`](../codeception.yml).

> Catatan: test yang ada saat ini masih bawaan template Yii2 Basic
> (Login dan Contact). Belum ada test untuk model dan controller KBLI
> (`Kategori`, `GolonganPokok`, `Golongan`, `SubGolongan`, `Kelompok`).

## Struktur

| Direktori | Isi |
|---|---|
| `tests/unit/` | Unit test model (`LoginFormTest`, `ContactFormTest`) |
| `tests/functional/` | Test fungsional: request web diemulasi tanpa browser (`LoginFormCest`, `ContactFormCest`) |
| `tests/acceptance/` | Test acceptance via browser (WebDriver). Butuh server web dan Selenium |
| `tests/_support/` | Class tester (`UnitTester`, `FunctionalTester`, `AcceptanceTester`) |
| `tests/_data/` | Data dan fixture test |
| `tests/_output/` | Hasil dan log test (diabaikan git) |

Konfigurasi suite: `unit.suite.yml`, `functional.suite.yml`, dan
`acceptance.suite.yml.example`.

## Prasyarat

1. PHP dan Composer terpasang.
2. Dependensi dev terpasang:

   ```
   cd yii2app
   composer install
   ```

3. Database khusus test. `config/test_db.php` memakai database
   `yii2basic_test`, bukan `kbli`. **Jangan** arahkan test ke database
   development atau produksi.

   ```
   mysql -u root -p -e "CREATE DATABASE yii2basic_test CHARACTER SET utf8;"
   mysql -u root -p yii2basic_test < ../mysql/create-table.sql
   ```

   Username dan password database mengikuti `config/db.php`
   (default `kbli`/`kbli`). Pastikan user tersebut punya akses ke
   `yii2basic_test`.

4. Bangun class tester setiap menambah atau menghapus modul:

   ```
   vendor/bin/codecept build
   ```

## Pengujian dengan PHP 8.4

Environment pengembangan memakai PHP 8.4. Saat dokumen ini ditulis, PHP 8.4
**tidak terdeteksi** dari shell yang saya pakai (`/usr/bin/php` adalah 7.4.33,
`phpbrew list` kosong), jadi bagian ini disusun dari `composer.lock` dan
**belum dijalankan**.

Cek PHP yang aktif sebelum mulai:

```
php -v                       # harus 8.4.x
php -m | grep -iE 'pdo_mysql|mbstring|intl|zip|curl|dom|xml'
```

Jika memakai phpbrew: `phpbrew use php-8.4` (atau `phpbrew switch php-8.4`).
Ekstensi `pdo_mysql` wajib ada.

### Dependensi dev yang tidak cocok dengan PHP 8.4

Dari `composer.lock`, paket berikut membatasi versi PHP, sehingga
`composer install` untuk dependensi dev diperkirakan **gagal** di 8.4:

| Paket (terkunci) | Batas PHP | Masalah |
|---|---|---|
| `codeception/module-yii2` 1.1.5 | `<=8.1 \| ~8.1.0` | Tidak mendukung 8.2 ke atas |
| `symfony/browser-kit` v4.2.4 | `^7.1.3` | Hanya PHP 7. Dikunci oleh `<=4.2.4` di `composer.json` |
| `codeception/codeception` 4.2.2 | `>=5.6 <9.0` | Terlalu lama untuk 8.4 |
| `phpunit/phpunit` 8.5.41 | `>=7.2` | Bisa jalan, tetapi mengeluarkan deprecation di 8.4 |
| `swiftmailer/swiftmailer` 6.3.0 | `>=7.0.0` | Sudah deprecated; ada deprecation di 8.4 |

Paket runtime utama (`yiisoft/yii2` 2.0.52, syarat `>=7.3.0`) tidak membatasi
batas atas.

### Langkah yang disarankan

1. Pasang dependensi runtime saja untuk memastikan aplikasi jalan:

   ```
   cd yii2app
   composer install --no-dev
   ```

2. Untuk menjalankan test, perbarui dependensi dev. Ubah `composer.json`:

   - `codeception/codeception`: `^5.0`
   - `codeception/module-yii2`: `^2.0`
   - `codeception/module-asserts`, `codeception/module-filesystem`: `^3.0`
   - hapus `codeception/specify`, `codeception/verify`, dan batas
     `symfony/browser-kit` (`>=2.7 <=4.2.4`). Codeception 5 membawa versi
     yang cocok.

   Lalu:

   ```
   composer update codeception/* symfony/* phpunit/* --with-all-dependencies
   vendor/bin/codecept build
   ```

   Nama paket dan versi di atas perlu diperiksa dengan `composer why-not`
   atau `composer update --dry-run`, karena saya belum menjalankannya.

3. Codeception 5 mengubah format test: `Codeception\Test\Unit` sekarang dari
   `codeception/module-*`, dan helper `expect_that()` / `expect_not()` pada
   contoh di atas berasal dari `codeception/verify` 1.x. Dengan
   `codeception/verify` 3.x, gunakan `verify($x)->...` atau assertion PHPUnit
   (`$this->assertTrue(...)`). Test bawaan template (Login, Contact) mungkin
   perlu disesuaikan.

4. Jalankan test:

   ```
   vendor/bin/codecept run unit
   vendor/bin/codecept run functional
   ```

### Deprecation PHP 8.4

PHP 8.4 mengubah beberapa perilaku, antara lain parameter implisit nullable
(`Type $x = null`) yang kini deprecated. Deprecation dari vendor tidak
menggagalkan test, tetapi bisa mengotori output. Untuk melihat hanya masalah
dari kode proyek, jalankan:

```
php -d error_reporting="E_ALL & ~E_DEPRECATED" vendor/bin/codecept run unit
```

Jangan menyembunyikan deprecation dari kode di `models/`, `controllers/`
dan `config/`; perbaiki langsung.

### Checklist verifikasi

- [ ] `php -v` menunjukkan 8.4.x di shell yang menjalankan test
- [ ] `composer install` berhasil (runtime dan dev)
- [ ] Database `yii2basic_test` ada dan bisa diakses
- [ ] `codecept run unit` hijau
- [ ] `codecept run functional` hijau
- [ ] Tidak ada deprecation baru dari kode proyek

## Menjalankan test

Jalankan dari direktori `yii2app/`.

```
# semua suite kecuali acceptance
vendor/bin/codecept run unit
vendor/bin/codecept run functional

# satu file atau satu test
vendor/bin/codecept run unit models/LoginFormTest.php
vendor/bin/codecept run unit models/LoginFormTest.php:testLoginNoUser

# output rinci
vendor/bin/codecept run --debug
```

### Acceptance test

1. Salin konfigurasi contoh:

   ```
   cp tests/acceptance.suite.yml.example tests/acceptance.suite.yml
   ```

2. Jalankan Selenium Server atau geckodriver untuk browser (default Firefox).
3. Jalankan aplikasi di `http://127.0.0.1:8080/` memakai entry script
   `web/index-test.php` (hanya menerima akses dari localhost). Contoh server:

   ```
   php yii serve --docroot=./web --port=8080
   ```

4. Jalankan:

   ```
   vendor/bin/codecept run acceptance
   ```

## Code coverage

Aktifkan blok `coverage` di `codeception.yml` (butuh Xdebug atau PCOV), lalu:

```
vendor/bin/codecept run --coverage --coverage-html
```

Laporan HTML ada di `tests/_output/coverage/`.

## Menulis test baru

### Unit test model

Buat file di `tests/unit/models/`, contoh `KategoriTest.php`:

```php
<?php

namespace tests\unit\models;

use app\models\Kategori;

class KategoriTest extends \Codeception\Test\Unit
{
    public function testKodeWajibDiisi()
    {
        $model = new Kategori(['judul' => 'Pertanian']);
        expect_not($model->validate());
        expect_that($model->hasErrors('kd'));
    }

    public function testKodeMaksimalSatuKarakter()
    {
        $model = new Kategori(['kd' => 'AB', 'judul' => 'Pertanian']);
        expect_not($model->validate(['kd']));
    }
}
```

### Test fungsional controller

Buat Cest di `tests/functional/`:

```php
<?php

class KategoriCest
{
    public function halamanIndexTampil(\FunctionalTester $I)
    {
        $I->amOnRoute('kategori/index');
        $I->seeResponseCodeIs(200);
    }
}
```

## Saran cakupan test

- Validasi `rules()` tiap model: field wajib, panjang maksimum, dan `unique`.
- CRUD tiap controller, termasuk 404 untuk ID yang tidak ada.
- `delete` hanya menerima POST.
- Akses create, update dan delete tanpa login. Saat ini tidak ada
  `AccessControl`, jadi test ini akan gagal sampai access control ditambahkan.
- Hierarki data: kategori → golongan pokok → golongan → sub-golongan → kelompok.

## Masalah yang diketahui

- `test_db.php` memakai nama database `yii2basic_test`, sisa dari template.
- Test Login dan Contact bergantung pada `User` hardcoded
  (`admin/admin`, `demo/demo`). Test ini akan rusak jika autentikasi diganti.
