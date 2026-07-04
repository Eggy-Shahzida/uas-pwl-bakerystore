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