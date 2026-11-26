# kbli

Klasifikasi Baku Lapangan Usaha Indonesia

Berikut adalah data referensi KBLI sesuai peraturan Kepala Badan Pusat Statistik
sesuai [referensi](referensi).

Aplikasi web (Yii 2 + MariaDB/MySQL) untuk menelusuri hierarki KBLI:
kategori → golongan pokok → golongan → sub-golongan → kelompok.

## Struktur

| Direktori | Isi |
|---|---|
| `yii2app/` | Aplikasi Yii 2 |
| `mysql/` | Skema (`create-table.sql`), pembuatan user (`create-user.sql`), dan data (`hasil-tabel.sql`) |
| `csv/` | Data kategori KBLI 2009 |
| `referensi/` | Peraturan BPS dan dokumen ISIC Rev 4 |
| `design/` | Mockup HTML dan CSS |

Dokumentasi lain:

- [DEVELOPMENT.md](DEVELOPMENT.md): lingkungan pengembangan (PHP dengan phpbrew)
- [yii2app/tests/README.md](yii2app/tests/README.md): pengujian
- [README-Yii1.md](README-Yii1.md): riwayat Yii 1 dan panduan porting ke Yii 2

## Pengembangan

Ringkasan langkah untuk menjalankan aplikasi secara lokal. Detail PHP 8.4,
phpbrew, dan masalah umum ada di [DEVELOPMENT.md](DEVELOPMENT.md).

### 1. Prasyarat

- PHP dengan ekstensi `pdo_mysql`, `mbstring`, `intl`, `zip`, `curl`, `dom`
  (target pengembangan: PHP 8.4, lihat [DEVELOPMENT.md](DEVELOPMENT.md)).
- Composer
- MariaDB atau MySQL
- Git

Pengguna phpbrew:

```
phpbrew use php-8.4.28
php -v
```

### 2. Ambil kode dan pasang dependensi

```
git clone https://github.com/idx-repo/kbli.git
cd kbli/yii2app
composer install --no-dev
```

`composer install` tanpa `--no-dev` memasang dependensi test. Dependensi itu
saat ini belum cocok dengan PHP 8.4, lihat
[yii2app/tests/README.md](yii2app/tests/README.md#pengujian-dengan-php-84).

### 3. Siapkan database

Jalankan dari direktori root repo. Periksa isi berkas SQL sebelum
menjalankannya: `create-table.sql` melakukan `DROP DATABASE IF EXISTS kbli`.

```
sudo mysql < mysql/create-user.sql
sudo mysql < mysql/create-table.sql
sudo mysql kbli < mysql/hasil-tabel.sql
```

Koneksi aplikasi diatur di `yii2app/config/db.php` (default: database `kbli`,
user `kbli`, password `kbli`). Ganti password untuk lingkungan selain lokal.

### 4. Jalankan aplikasi

```
cd yii2app
mkdir -p runtime web/assets
php yii serve --docroot=web --port=8080
```

Buka <http://localhost:8080/>.

- Halaman daftar (`/kategori`, `/golpok`, `/gol`, `/subgol`, `/kelompok`)
  terbuka untuk publik.
- Menambah, mengubah, dan menghapus data memerlukan login. Saat ini akun masih
  bawaan template di `yii2app/models/User.php` (`admin/admin`). Jangan dipakai
  di server publik.
- Mode debug dan Gii aktif jika `YII_ENV` bernilai `dev`.

### 5. Alur kerja harian

```
git pull
cd yii2app
composer install --no-dev
php yii serve --docroot=web --port=8080
```

Menambah fitur atau entitas:

1. Ubah skema di `mysql/create-table.sql` (dan data di `mysql/hasil-tabel.sql`
   bila perlu).
2. Buat model dan CRUD dengan Gii di `/gii` (hanya dari localhost), atau tulis
   manual di `yii2app/models/` dan `yii2app/controllers/`.
3. Tambahkan `AccessControl` pada controller baru. Controller hasil Gii tidak
   membatasi akses. Contoh ada di `yii2app/controllers/KategoriController.php`.
4. Tulis test untuk model dan controller baru.
5. Jalankan test (lihat
   [yii2app/tests/README.md](yii2app/tests/README.md)).
6. Commit dengan pesan yang menjelaskan perubahan.

Konvensi yang dipakai:

- Nama tabel mengikuti skema (`kategori`, `gol_pok`, `gol`, `sub_gol`,
  `kelompok`). Nama class model memakai bahasa Indonesia lengkap
  (`GolonganPokok`, `SubGolongan`).
- Controller dan folder view memakai huruf kecil (`golpok`, `subgol`).
- Daftar data diurutkan menurut kodenya (`defaultOrder` pada
  `ActiveDataProvider`).

### 6. Docker (opsional)

```
cd yii2app
docker-compose up
```

Aplikasi tersedia di <http://localhost:8000/> (PHP 7.4 + Apache). Database
tetap harus tersedia dan `config/db.php` menyesuaikan hostnya.

## Instalasi (OpenSUSE)

Sebelumnya install apache2 dan mariadb terlebih dulu. Siapkan database seperti
pada langkah 3 di atas.

### Clone proyek pada direktori kerja server.

```
mkdir -p /srv/www/yii2
cd /srv/www/yii2
git clone https://github.com/idx-repo/kbli.git
```

### Composer update

```
cd kbli/yii2app
composer update
```

### Runtime

```
chown wwwrun runtime/
```

### Direktori kerja apache

```
cd /srv/www/htdocs
mkdir kbli
cd kbli
mkdir assets
chown wwwrun assets
cp /srv/www/yii2/kbli/yii2app/.htaccess .htaccess
cp -r /srv/www/yii2/kbli/yii2app/web/css css
```

Masih dalam folder kbli, ubah isi `index.php` sbb:

```
<?php
require __DIR__ . '/../../yii2/kbli/yii2app/vendor/autoload.php';
require __DIR__ . '/../../yii2/kbli/yii2app/vendor/yiisoft/yii2/Yii.php';
$config = require __DIR__ . '/../../yii2/kbli/yii2app/config/web.php';
(new yii\web\Application($config))->run();
```

Pretty URL aktif di `config/web.php` dan memerlukan `mod_rewrite` serta
`AllowOverride All` pada direktori tersebut agar `.htaccess` terbaca.

### Catatan

Sesuaikan direktori pemasangan. Konfigurasi dan preferensi boleh berbeda.

Untuk produksi:

- Ganti `cookieValidationKey` di `config/web.php` dan password database di
  `config/db.php`.
- Ganti akun di `models/User.php`.
- Jangan aktifkan `YII_DEBUG` dan `YII_ENV_DEV`; `index.php` di atas sudah
  tidak mengaktifkannya.
