<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Konfigurasi Aplikasi
|--------------------------------------------------------------------------
| Berisi seluruh konfigurasi global yang digunakan oleh aplikasi.
| Jika suatu saat aplikasi dipindahkan ke komputer lain, cukup ubah file ini.
*/

/*
|--------------------------------------------------------------------------
| Database Configuration
|--------------------------------------------------------------------------
*/

define('DB_HOST', 'localhost');
define('DB_NAME', 'breadshop_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/*
|--------------------------------------------------------------------------
| Application Configuration
|--------------------------------------------------------------------------
*/

define('APP_NAME', 'BreadShop');
define('BASE_URL', 'http://localhost/bakery/public');

/*
|--------------------------------------------------------------------------
| Shipping API Configuration (BinderByte)
|--------------------------------------------------------------------------
|
| API Key BinderByte digunakan untuk:
| - Mengambil daftar provinsi
| - Mengambil daftar kota
| - Menghitung ongkos kirim
|
*/

define('RAJA_API_KEY', '85DkdkaS6c1a3378259134bd4bbDJPCg');

define(
    'RAJA_BASE_URL',
    'https://rajaongkir.komerce.id'
);

/*
|--------------------------------------------------------------------------
| Lokasi Toko
|--------------------------------------------------------------------------
*/

define('STORE_CITY_ID', '33.74');

define('STORE_WEIGHT_DEFAULT', 1000);

/*
|--------------------------------------------------------------------------
| Timezone
|--------------------------------------------------------------------------
*/

date_default_timezone_set('Asia/Jakarta');

/*
|--------------------------------------------------------------------------
| Upload Configuration
|--------------------------------------------------------------------------
*/

define('UPLOAD_PATH', PUBLIC_PATH . '/uploads/products/');
define('UPLOAD_URL', BASE_URL . '/uploads/products/');

/*
|--------------------------------------------------------------------------
| Pagination
|--------------------------------------------------------------------------
*/

define('ITEMS_PER_PAGE', 10);