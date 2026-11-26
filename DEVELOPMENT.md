# Panduan Pengembangan

Panduan ini untuk menjalankan aplikasi `yii2app/` secara lokal. Ada dua jalur:
environment bawaan sistem, dan PHP lewat [phpbrew](https://github.com/phpbrew/phpbrew).

## Environment saat ini

Hasil pengecekan di mesin pengembangan:

| Komponen | Versi |
|---|---|
| OS | openSUSE Leap 15.6 |
| PHP (sistem) | 7.4.33 CLI |
| Composer | `/usr/bin/composer` |
| Database | MariaDB 10.11.15 |
| phpbrew | 2.2.0 (`~/.local/bin/phpbrew`) |
| Git | tersedia |

Dari `composer.lock`: Yii 2.0.52. Sebagian dependensi mensyaratkan PHP `>=7.2`,
dan `docker-compose.yml` memakai PHP 7.4. **Target pengembangan sekarang: PHP 8.4** (lihat catatan kompatibilitas test di [yii2app/tests/README.md](yii2app/tests/README.md#pengujian-dengan-php-84)). PHP 7.4 tetap opsi paling aman untuk dependensi dev yang terkunci. Proyek ini
belum diuji di PHP 8 dan belum ada `pdo_mysql` di PHP sistem (lihat di bawah).

> [!IMPORTANT]
> PHP sistem saat ini **belum punya ekstensi `pdo_mysql`**. Modul yang
> terpasang hanya `pdo_sqlite` (dan `mysqlnd` tidak tampil). Aplikasi memakai
> `mysql:` DSN, jadi tanpa ekstensi itu koneksi database gagal. Pasang paket
> `php7-pdo`/`php7-mysql` (nama paket bisa berbeda di openSUSE), atau pakai
> PHP dari phpbrew dengan varian `+mysql`.

## Jalur A: PHP sistem

```
cd yii2app
php -v
php -m | grep -i pdo
composer install
```

Lalu lanjut ke [Database](#database) dan [Menjalankan aplikasi](#menjalankan-aplikasi).

## Jalur B: PHP dengan phpbrew

Pakai jalur ini untuk memasang versi PHP tertentu (misalnya 7.4.x) tanpa
mengubah PHP sistem.

### 1. Inisialisasi

```
phpbrew init
```

Tambahkan ke `~/.bashrc` (atau `~/.zshrc`):

```
[[ -e ~/.phpbrew/bashrc ]] && source ~/.phpbrew/bashrc
```

Buka shell baru, lalu cek:

```
phpbrew known
phpbrew lookup-prefix suse
```

### 2. Paket build di openSUSE

phpbrew mengompilasi PHP dari sumber. Pasang dulu alat dan header yang
dibutuhkan (nama paket bisa bergantung versi openSUSE):

```
sudo zypper install -t pattern devel_basis
sudo zypper install libxml2-devel libopenssl-devel libcurl-devel \
  libicu-devel oniguruma-devel libzip-devel sqlite3-devel \
  libpng16-devel libjpeg8-devel readline-devel libxslt-devel \
  autoconf bison re2c
```

Untuk MariaDB, pasang juga header klien (`libmariadb-devel` atau
`libmariadbclient-devel`).

### 3. Pasang PHP

```
phpbrew install 7.4 as php-7.4 +default +mb +intl +pdo +mysql +sqlite +curl +zip +openssl +bcmath +iconv +dom +xml
phpbrew switch php-7.4
php -v
php -m | grep -iE 'pdo_mysql|intl|mbstring|zip|curl'
```

Catatan:
- Kompilasi bisa makan waktu lama. Tambahkan `-j $(nproc)` untuk mempercepat.
- Jika `phpbrew install` gagal, baca `~/.phpbrew/build/<versi>/build.log`.
  Penyebab umum adalah header `-devel` yang kurang atau OpenSSL terlalu baru
  untuk PHP 7.4.
- `phpbrew switch` hanya berlaku di shell itu. Pakai `phpbrew use php-7.4`
  untuk sementara, atau `phpbrew switch` untuk default.
- Ekstensi tambahan: `phpbrew ext install xdebug` (perlu untuk coverage).

### 4. Composer

Composer sistem akan dijalankan dengan PHP aktif phpbrew. Cek:

```
composer --version
composer diagnose
```

Jika bermasalah, pasang Composer di dalam phpbrew: `phpbrew self-update` hanya
memperbarui phpbrew, jadi unduh `composer.phar` dari getcomposer.org.

### 5. Pasang dependensi

```
cd yii2app
composer install
```

## Catatan instalasi PHP 8.4 (phpbrew)

Perintah yang dipakai di mesin pengembangan:

```
phpbrew install 8.4 +default +mysql
phpbrew use php-8.4.28        # atau: phpbrew switch php-8.4.28
```

Hasilnya: PHP **8.4.28** terpasang di `~/.phpbrew/php/php-8.4.28`
(build sekitar 21 menit). Konfigurasi ada di
`~/.phpbrew/php/php-8.4.28/etc/cli/php.ini`.

Pesan berikut muncul saat build dan **tidak menghalangi** hasilnya:

| Pesan | Arti |
|---|---|
| `Patch failed` pada `ext/readline/config.m4` | Patch itu hanya untuk PHP 5.3 sampai 7.1. Tidak dipakai di 8.4. |
| `sh: pear: command not found` | PEAR tidak ikut terpasang. Tidak dibutuhkan proyek ini (pakai Composer). |

Setelah memasang, cek di shell yang sudah memuat phpbrew:

```
php -v                                   # 8.4.28
php -m | grep -iE 'pdo_mysql|mbstring|intl|zip|curl|dom|xml'
```

Jika `intl` tidak ada (Yii memakainya untuk formatter, dan paket proyek
`yiisoft/yii2` menyarankannya), bangun ulang dengan varian `+intl`, atau
`phpbrew ext install intl`. Atur juga `pdo_mysql.default_socket` di `php.ini`
jika MariaDB memakai socket di lokasi non-standar, misalnya
`/run/mysql/mysql.sock` di openSUSE.

Lanjutkan dengan `composer install --no-dev`, lalu lihat
[yii2app/tests/README.md](yii2app/tests/README.md#pengujian-dengan-php-84)
untuk dependensi test.

## Database

1. Pastikan MariaDB berjalan:

   ```
   sudo systemctl start mariadb
   ```

2. Buat user dan skema memakai berkas di `mysql/`:

   ```
   sudo mysql < mysql/create-user.sql
   sudo mysql < mysql/create-table.sql
   sudo mysql kbli < mysql/hasil-tabel.sql
   ```

   Baca isi berkasnya dulu, karena urutan dan nama database bisa berbeda dari
   contoh di atas. Kredensial default di `yii2app/config/db.php` adalah
   `kbli`/`kbli` pada database `kbli`.

3. Untuk test, buat database `yii2basic_test`. Lihat
   [yii2app/tests/README.md](yii2app/tests/README.md).

## Menjalankan aplikasi

Server bawaan Yii (cukup untuk pengembangan):

```
cd yii2app
php yii serve --docroot=web --port=8080
```

Buka `http://localhost:8080/`. Entry script `web/index.php` dipakai.

Alternatif lain:
- **Docker**: `docker-compose up` di `yii2app/` (PHP 7.4 + Apache, port 8000).
- **Apache**: ikuti bagian Instalasi di [README.md](README.md).

Direktori `runtime/` dan `web/assets/` harus bisa ditulis oleh proses PHP.

## Alur kerja sehari-hari

```
git pull
cd yii2app
composer install
php yii serve --docroot=web --port=8080
```

- Mode debug dan Gii aktif jika `YII_ENV` bernilai `dev`. Gii ada di
  `/index.php?r=gii`. Hanya boleh dibuka dari localhost.
- Menjalankan test: lihat [yii2app/tests/README.md](yii2app/tests/README.md).
- Riwayat dan versi lama (Yii 1): lihat [README-Yii1.md](README-Yii1.md).

## Memakai beberapa versi PHP

```
phpbrew list                 # versi terpasang
phpbrew use php-7.4          # shell saat ini saja
phpbrew switch php-7.4       # default
phpbrew off                  # kembali ke PHP sistem
phpbrew clean php-7.4        # bersihkan berkas build
```

Untuk mengecek apakah aplikasi bisa jalan di PHP 8, pasang versi 8.x di
phpbrew lalu jalankan `composer install` dan test. Pakai `phpbrew use` supaya
PHP 7.4 tetap menjadi default.

## Masalah umum

| Gejala | Penyebab dan solusi |
|---|---|
| `could not find driver` | `pdo_mysql` belum terpasang. Pasang ekstensi atau pakai PHP phpbrew dengan `+mysql`. |
| `Access denied for user 'kbli'` | User belum dibuat atau password beda dengan `config/db.php`. |
| `Unable to write ... runtime` | Beri izin tulis ke `runtime/` dan `web/assets/`. |
| `composer install` meminta versi PHP lain | Cek `php -v` dan `composer config platform`. Pastikan PHP phpbrew aktif. |
| Kompilasi phpbrew gagal | Lihat `build.log`. Biasanya header `-devel` kurang. |

## Catatan keamanan

- `config/web.php` dan `config/db.php` berisi `cookieValidationKey` dan
  password database di dalam repo. Ganti untuk lingkungan selain lokal.
- `models/User.php` masih memakai akun bawaan template (`admin/admin`,
  `demo/demo`). Jangan dipakai di server publik.
- Pastikan `YII_ENV` bukan `dev` di produksi.

> [!NOTE]
> Perintah phpbrew dan zypper di atas belum saya jalankan. Daftar paket dan
> opsi varian disusun dari dokumentasi umum phpbrew dan bisa perlu
> penyesuaian di mesin Anda.
