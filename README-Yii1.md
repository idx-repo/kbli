# Riwayat Yii 1 pada Proyek KBLI

Dokumen ini merangkum hasil penelusuran riwayat git. Sebelum dimigrasikan ke
Yii 2 (`yii2app/`), proyek ini dibangun dengan **Yii 1.1**.

## Linimasa

| Tanggal | Commit | Peristiwa |
|---|---|---|
| 2014-06-16 | `0136e7d` | Initial commit; data referensi (PDF KBLI 2009, CSV kategori) |
| 2014-06-17 | `2e2e7b6` | Framework **Yii 1.1.14** dimasukkan ke repo (`framework/`) |
| 2014-06-17 | `b2d4bbd` | Aplikasi web dibuat dengan `yiic webapp` (`www/`) |
| 2014-06-17 | `93b0c4c` | Skema database MySQL (`mysql/`) |
| 2014-06-17 sampai 18 | `2b3a32a` .. `8787ad5` | Konfigurasi, desain gelap, model dan CRUD (Gii), menu, GridView; halaman About dan Contact dihapus |
| 2014-06-22 sampai 12-23 | `7b47363` .. `874473d` | Perapian controller dan view (golpok, subgol, kelompok) |
| 2014-07-05 | `c01be3e` | Update ke Yii 1.1.15 |
| 2014-12-22 | `af46da1` | Update ke Yii 1.1.16 |
| 2014-11 sampai 2021-08 | puluhan commit "update yii" | Pembaruan `framework/` secara berkala, tanpa perubahan fitur |
| 2021-08-05 | `8098423`, `f0fb90d` | Pembaruan Yii 1 terakhir |
| 2021-08-14 | `b022dbd` | **"yii2-based app init"**: `framework/` dan `www/` dihapus, `yii2app/` dibuat |
| 2021-08-16 | `ee79017` | Data KBLI 2017 |
| 2021-09 dan seterusnya | `75c4679` .. | Hanya pembaruan composer dan perbaikan kecil |

Versi framework pada commit terakhir sebelum migrasi: **1.1.25-dev**
(dari `YiiBase::getVersion()` pada `b022dbd^`).

Migrasi berlangsung dalam satu commit (`b022dbd`). Commit itu menghapus sekitar
1.680 file framework dan semua file aplikasi lama.

## Struktur aplikasi Yii 1

Commit terakhir yang masih memakai Yii 1 adalah **`b022dbd^`**.

```
framework/                      Yii 1.1 (disalin ke repo)
www/
  index.php                     entry script (YII_DEBUG = true)
  index-test.php
  css/, assets/, themes/
  protected/
    config/main.php, console.php, test.php
    components/Controller.php, UserIdentity.php
    controllers/  Kategori, GolPok, Gol, SubGol, Kelompok, Site
    models/       Kategori, GolPok, Gol, SubGol, Kelompok, LoginForm, ContactForm
    views/        kategori, golPok, gol, subGol, kelompok, layouts, site
    data/         schema.mysql.sql, schema.sqlite.sql
    tests/        phpunit.xml, functional/SiteTest.php
    yiic, yiic.php
mysql/                          create-table.sql, create-user.sql, hasil-tabel.sql
csv/, design/, referensi/
```

### Konfigurasi (`www/protected/config/main.php`)

- Nama aplikasi: "Klasifikasi Baku Lapangan Usaha Indonesia".
- Modul **Gii** aktif dengan filter IP `127.0.0.1` dan `::1`.
- `urlManager` memakai format `path` dengan aturan
  `<controller>/<id>` → `view`, `<controller>/<action>/<id>`, dan
  `<controller>/<action>`.
- Database: MySQL `kbli`, user `kbli`, password `kbli`, `charset=utf8`.
- Log ke file untuk level `error` dan `warning`.

## Perbandingan Yii 1 dan Yii 2 pada proyek ini

| Aspek | Yii 1 (`www/`) | Yii 2 (`yii2app/`) |
|---|---|---|
| Framework | Disalin ke repo (`framework/`) | Composer (`yiisoft/yii2 ~2.0.14`) |
| Model | `Gol`, `GolPok`, `SubGol`, `Kelompok`, `Kategori` | `Golongan`, `GolonganPokok`, `SubGolongan`, `Kelompok`, `Kategori` |
| Controller | `GolPokController`, `SubGolController` | `GolpokController`, `SubgolController` |
| Config | `config/main.php` (array) | `config/web.php`, `db.php`, `params.php` |
| Pretty URL | Aktif (`path`) | Dikomentari (belum aktif) |
| Gii | Password `kbli` dan filter IP | Aktif saat `YII_ENV_DEV` |
| Test | PHPUnit (`WebTestCase`) | Codeception |
| Perintah konsol | `yiic` | `yii` |

Aturan URL Yii 1 yang di Yii 2 masih dikomentari perlu dibuat ulang di
`urlManager` jika URL lama ingin dipertahankan.

## Cara melihat atau menjalankan versi Yii 1

Pakai worktree terpisah supaya working copy utama tidak berubah:

```
git worktree add ../kbli-yii1 b022dbd^
cd ../kbli-yii1
```

Lalu:

1. Siapkan database seperti README utama (`mysql/create-user.sql`,
   `mysql/create-table.sql`, `mysql/hasil-tabel.sql`).
2. Arahkan web server atau PHP built-in server ke `www/`:

   ```
   php -S localhost:8080 -t www
   ```

3. Pastikan `www/assets` dan `www/protected/runtime` bisa ditulis.

> [!WARNING]
> Yii 1.1.25-dev dan kodenya dibuat untuk PHP lama. Pada PHP 8 kemungkinan ada
> error atau deprecation. Saya belum mencobanya. Cara paling aman adalah
> memakai PHP 5.x atau 7.x, misalnya lewat container.

## Catatan

- Yii 1.1 sudah dinyatakan end of life. Versi Yii 1 di repo ini tidak lagi
  mendapat pembaruan keamanan resmi.
- Kredensial lama (`kbli/kbli`, password Gii `kbli`) masih ada di riwayat git
  dan di `yii2app/config/db.php`. Ganti kredensial itu jika pernah dipakai di
  server publik.
- Ringkasan ini berasal dari log git, daftar file, dan `main.php` pada
  `b022dbd^`. Isi controller, model dan view Yii 1 belum dibaca satu per satu.

---

# Panduan Porting Yii 1 ke Yii 2

Bagian ini menjelaskan apa yang berubah saat proyek dipindahkan dari
`www/protected/` (Yii 1) ke `yii2app/` (Yii 2), dan apa yang masih harus
diselesaikan. Dasarnya adalah perbandingan `GolPok`/`GolPokController` (Yii 1)
dengan `GolonganPokok`/`GolpokController` (Yii 2), skema `mysql/create-table.sql`,
dan `config/main.php` lama. Entitas lain (`Kategori`, `Gol`, `SubGol`,
`Kelompok`) belum dibandingkan satu per satu, jadi cek ulang pola yang sama di
sana.

## Peta berkas

| Yii 1 | Yii 2 |
|---|---|
| `framework/` | `vendor/yiisoft/yii2` (Composer) |
| `www/index.php` | `yii2app/web/index.php` |
| `www/protected/config/main.php` | `yii2app/config/web.php`, `db.php`, `params.php` |
| `www/protected/yiic` | `yii2app/yii` |
| `models/GolPok.php` (`GolPok`) | `models/GolonganPokok.php` |
| `models/Gol.php` | `models/Golongan.php` |
| `models/SubGol.php` | `models/SubGolongan.php` |
| `controllers/GolPokController.php` | `controllers/GolpokController.php` |
| `controllers/SubGolController.php` | `controllers/SubgolController.php` |
| `views/golPok/`, `views/subGol/` | `views/golpok/`, `views/subgol/` (huruf kecil) |
| `components/UserIdentity.php` | `models/User.php` (implements `IdentityInterface`) |
| `css/` | `web/css/site.css` |

Nama tabel tidak berubah (`kategori`, `gol_pok`, `gol`, `sub_gol`, `kelompok`),
jadi database lama bisa dipakai langsung. Yang diganti hanya nama class dan
URL: `golPok/...` menjadi `golpok/...` dan `subGol/...` menjadi `subgol/...`.
Controller class diubah, tetapi nama tabel tetap lewat `tableName()`.

## Padanan kode

| Yii 1 | Yii 2 |
|---|---|
| `class GolPok extends CActiveRecord` | `class GolonganPokok extends \yii\db\ActiveRecord` dengan namespace `app\models` |
| `public function tableName()` | `public static function tableName()` |
| `GolPok::model()->findByPk($id)` | `GolonganPokok::findOne($id)` |
| `new CDbCriteria` + `compare()` | `Model::find()->where([...])` atau `andFilterWhere()` |
| `CActiveDataProvider($this, ['criteria'=>...])` | `ActiveDataProvider(['query'=>...])` |
| `array('judul', 'length', 'max'=>200)` | `[['judul'], 'string', 'max' => 200]` |
| `array('kategori', 'numerical', 'integerOnly'=>true)` | `[['kategori'], 'integer']` |
| `array('deskripsi', 'safe')` | `[['deskripsi'], 'safe']`, atau `'string'` |
| `$model->attributes = $_POST['X']` | `$model->load(Yii::$app->request->post())` |
| `isset($_POST['X'])` | `Yii::$app->request->isPost` |
| `$this->redirect(array('view','id'=>$id))` | `return $this->redirect(['view', 'id' => $id])` |
| `$this->render(...)` | `return $this->render(...)` (wajib `return`) |
| `throw new CHttpException(404, ...)` | `throw new NotFoundHttpException(...)` |
| `filters()` + `accessRules()` | `behaviors()` dengan `AccessControl` dan `VerbFilter` |
| `'postOnly + delete'` | `VerbFilter` dengan `'delete' => ['POST']` |
| `Yii::app()->user` | `Yii::$app->user` |
| `CHtml::link(...)`, `CActiveForm` | `yii\helpers\Html`, `yii\widgets\ActiveForm` |
| `$this->layout = '//layouts/column2'` | `$this->layout = 'main'` atau layout sendiri |
| Gii `CrudCode` kustom di `runtime/gii-1.1.14/` | Template Gii Yii 2 (perlu dibuat ulang jika ingin tampilan sama) |

## Perbedaan perilaku yang perlu diketahui

### 1. Akses (regresi keamanan) — sudah diperbaiki

> Status: diterapkan di kelima controller. Berbeda dari Yii 1, `index` dan `view`
> sengaja dibuka untuk publik (data referensi). Jika ingin sama persis dengan
> Yii 1, ubah aturan pertama di `behaviors()` menjadi `'roles' => ['@']`.

Di Yii 1, `GolPokController` memakai `accessControl`: `index`, `view`,
`create`, `update` hanya untuk pengguna login (`'users'=>array('@')`), dan
semua lainnya ditolak. Di Yii 2, controller hasil Gii hanya memakai
`VerbFilter` (`delete` hanya POST). **Tidak ada `AccessControl`**, sehingga
siapa pun bisa membuat, mengubah, dan menghapus data.

Perbaikan: tambahkan ke `behaviors()` tiap controller.

```php
'access' => [
    'class' => \yii\filters\AccessControl::class,
    'rules' => [
        ['allow' => true, 'actions' => ['index', 'view'], 'roles' => ['?', '@']],
        ['allow' => true, 'actions' => ['create', 'update', 'delete'], 'roles' => ['@']],
    ],
],
```

Pilih apakah `index` dan `view` boleh dibuka publik. Aturan Yii 1 menutup semua
action untuk tamu.

### 2. Autentikasi

Yii 1 memakai `UserIdentity` bawaan template. Yii 2 memakai `models/User.php`
dengan akun hardcoded (`admin/admin`, `demo/demo`). Keduanya bukan
autentikasi sungguhan. Untuk produksi, simpan pengguna di tabel database dan
hash password dengan `Yii::$app->security->generatePasswordHash()`.

### 3. Validasi

Yii 2 menambahkan aturan `unique` untuk `kd`, `gol_pok`, dan sejenisnya. Aturan
ini sebelumnya hanya dijaga oleh indeks UNIQUE di database. Data lama yang
duplikat tidak akan bisa disimpan ulang lewat form.

### 4. Skema database

`mysql/create-table.sql` memakai `ENGINE=MyISAM`. MyISAM **mengabaikan**
`FOREIGN KEY ... ON DELETE CASCADE`, sehingga hapus induk tidak menghapus anak.
Di Yii 1 maupun Yii 2 tidak ada kode yang menghapus anak secara manual. Jika
ingin cascade berjalan, ubah ke `InnoDB`. Itu mengubah database, jadi uji dulu
di salinan.

### 5. URL — sudah diperbaiki

> Status: `urlManager` sudah aktif di `config/web.php` dengan tiga aturan lama.

Yii 1 mengaktifkan pretty URL (`urlFormat => path`) dengan tiga aturan
(`<controller>/<id>` → `view`, dan seterusnya). Di `config/web.php` Yii 2,
`urlManager` masih dikomentari. Agar URL lama tetap jalan:

```php
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    ],
],
```

Di Apache butuh `.htaccess` dengan `RewriteEngine` (ada `yii2app/.htaccess`;
cek isinya). Nama controller dan URL berubah huruf (`golPok` → `golpok`),
jadi tambahkan redirect jika ada tautan lama di luar.

### 6. Konfigurasi

- Gii Yii 1 dilindungi password (`kbli`) dan filter IP. Gii Yii 2 hanya
  aktif saat `YII_ENV_DEV` dan membatasi ke localhost secara default. Atur
  `allowedIPs` jika perlu.
- Kredensial database tetap `kbli`/`kbli`, sekarang di `config/db.php`.
- `adminEmail` di `params.php` perlu dicek. Alamat email pribadi pada
  konfigurasi lama ada di riwayat git.

## Bug Yii 1 yang tidak perlu ikut dipindahkan

Ditemukan saat membaca `GolPokController` lama:

- `actionView` memeriksa `$_GET['Gol']` tetapi memakai `$_GET['SubGol']`
  (salin-tempel). Filter gridview tidak bekerja.
- `actionUpdate` mengarahkan ke `kategori/view` dengan id **golongan pokok**,
  bukan id kategori.
- `actionDelete` mengarah ke action `admin` yang tidak ada di controller itu.
- `accessRules` tidak mengizinkan `delete`, jadi hapus selalu ditolak.

Versi Yii 2 menyelesaikannya lewat `redirect(['index'])` pada delete dan
`ActiveDataProvider` pada view. Pastikan perilaku ini sesuai kebutuhan.

## Checklist porting

- [x] Model dan controller untuk 5 entitas
- [x] View CRUD per entitas
- [x] Konfigurasi database dan layout dasar
- [x] `AccessControl` di semua controller (`index`/`view` publik; `create`/`update`/`delete` wajib login)
- [ ] Autentikasi berbasis database (ganti `User` hardcoded)
- [x] Pretty URL sesuai aturan lama (`config/web.php`)
- [x] Urutan data (`defaultOrder`) pada `index` dan daftar golongan pokok di `kategori/view`
- [ ] Pencarian dan filter yang dulu ada di `search()` tiap model
- [ ] Engine tabel InnoDB jika cascade dibutuhkan
- [ ] Test untuk model dan controller KBLI
  ([yii2app/tests/README.md](yii2app/tests/README.md))
- [ ] Verifikasi di PHP 8.4 ([DEVELOPMENT.md](DEVELOPMENT.md))

## Menjalankan keduanya berdampingan untuk membandingkan

```
git worktree add ../kbli-yii1 b022dbd^
```

Jalankan Yii 1 di port berbeda (PHP 7.x) dan Yii 2 di PHP 8.4, dengan database
yang sama atau salinannya. Bandingkan halaman `kategori`, `golpok/view`, dan
halaman form untuk tiap entitas.
