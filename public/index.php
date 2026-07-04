<?php

declare(strict_types=1);
session_start();

/*
|--------------------------------------------------------------------------
| Path Configuration
|--------------------------------------------------------------------------
| Konstanta path yang digunakan di seluruh aplikasi.
| Dengan cara ini kita tidak perlu menulis path secara manual berulang kali.
*/

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('PUBLIC_PATH', ROOT_PATH . '/public');

/*
|--------------------------------------------------------------------------
| Load Configuration
|--------------------------------------------------------------------------
| File konfigurasi aplikasi akan dimuat di sini.
| (Akan dibuat pada sesi berikutnya)
*/

require_once CONFIG_PATH . '/config.php';

/*
|--------------------------------------------------------------------------
| Load Core Classes
|--------------------------------------------------------------------------
| Semua class inti MVC akan dimuat di sini.
| (Akan dibuat pada sesi berikutnya)
*/

require_once APP_PATH . '/core/Database.php';
require_once APP_PATH . '/core/Model.php';
require_once APP_PATH . '/core/Controller.php';
require_once APP_PATH . '/core/App.php';

/*
|--------------------------------------------------------------------------
| Run Application
|--------------------------------------------------------------------------
| Menjalankan aplikasi.
| Router akan dipanggil dari sini.
*/

$app = new App();
$app->run();