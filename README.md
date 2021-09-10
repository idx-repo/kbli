# kbli

Klasifikasi Baku Lapangan Usaha Indonesia

Berikut adalah data referensi KBLI sesuai peraturan Kepala Badan Pusat Statistik
Nomor 57 tahun 2009.

Akan dibentuk dalam beberapa format.

## Instalasi di OpenSUSE

Sebelumnya install apache2 dan mariadb terlebih dulu.

## Clone proyek pada direktori kerja server.

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

## Direktori kerja apache

```
cd /srv/www/htdocs
mkdir kbli
cd kbli
mkdir assets
chown wwwrun assets
cp /srv/www/yii2/kbli/yii2app/.htaccess .htaccess
```

Masih dalam folder kbli, ubah isi `index.php` sbb:

```
<?php
require __DIR__ . '/../../yii2/kbli/yii2app/vendor/autoload.php';
require __DIR__ . '/../../yii2/kbli/yii2app/vendor/yiisoft/yii2/Yii.php';
$config = require __DIR__ . '/../../yii2/kbli/yii2app/config/web.php';
(new yii\web\Application($config))->run();
```

## Catatan

Sesuaikan direktori pemasangan. Konfigurasi dan preferensi boleh berbeda.
