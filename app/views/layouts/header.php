<?php

/*
|--------------------------------------------------------------------------
| Layout Header
|--------------------------------------------------------------------------
| File ini digunakan sebagai template bagian atas seluruh halaman.
| Nantinya cukup dipanggil menggunakan:
|
| require_once APP_PATH . '/views/layouts/header.php';
|
*/
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'BreadShop'; ?></title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- CSS Aplikasi -->
    <link
        rel="stylesheet"
        href="<?= BASE_URL; ?>/assets/css/style.css">

</head>

<body class="bg-light">

    <!-- Container Utama -->
    <div class="container py-5">