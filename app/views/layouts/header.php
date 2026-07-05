<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Layout Header
|--------------------------------------------------------------------------
| Header global BreadShop.
|
| Digunakan oleh seluruh halaman aplikasi.
|
| Fitur:
| - Bootstrap 5
| - Bootstrap Icons
| - Responsive Navbar
| - Sticky Navbar
| - Guest Menu
| - Customer Menu
| - Admin Menu
| - Active Navigation
| - Dropdown User
|--------------------------------------------------------------------------
*/

if (!isset($title)) {
    $title = APP_NAME;
}

/*
|--------------------------------------------------------------------------
| Session User
|--------------------------------------------------------------------------
*/

$isLoggedIn = isset($_SESSION['user_id']);

$userName = $_SESSION['user_name'] ?? 'Guest';

$userRole = $_SESSION['user_role'] ?? 'guest';

/*
|--------------------------------------------------------------------------
| Active Menu
|--------------------------------------------------------------------------
*/

$currentUrl = $_GET['url'] ?? '';

$currentSegment = explode('/', $currentUrl)[0];

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title><?= htmlspecialchars($title); ?></title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">

    <div class="container">

        <!-- ===================================================== -->
        <!-- Logo -->
        <!-- ===================================================== -->

        <a
            class="navbar-brand fw-bold"
            href="<?= BASE_URL; ?>/">

            🍞 BreadShop

        </a>

        <!-- ===================================================== -->
        <!-- Mobile Button -->
        <!-- ===================================================== -->

        <button

            class="navbar-toggler"

            type="button"

            data-bs-toggle="collapse"

            data-bs-target="#navbarMain"

            aria-controls="navbarMain"

            aria-expanded="false"

            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- ===================================================== -->
        <!-- Menu -->
        <!-- ===================================================== -->

        <div
            class="collapse navbar-collapse"
            id="navbarMain">

            <!-- ================================================ -->
            <!-- Left Menu -->
            <!-- ================================================ -->

            <ul class="navbar-nav me-auto">

                <?php if ($userRole === 'admin') : ?>

                    <li class="nav-item">

                        <a
                            class="nav-link <?= $currentSegment === 'admin' ? 'active fw-semibold' : '' ?>"
                            href="<?= BASE_URL; ?>/admin">

                            Dashboard

                        </a>

                    </li>

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="<?= BASE_URL; ?>/admin/products">

                            Produk

                        </a>

                    </li>

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="<?= BASE_URL; ?>/admin/orders">

                            Pesanan

                        </a>

                    </li>

                <?php else : ?>

                    <li class="nav-item">

                        <a
                            class="nav-link <?= $currentSegment === '' ? 'active fw-semibold' : '' ?>"
                            href="<?= BASE_URL; ?>/">

                            Home

                        </a>

                    </li>

                    <li class="nav-item">

                        <a
                            class="nav-link <?= $currentSegment === 'products' ? 'active fw-semibold' : '' ?>"
                            href="<?= BASE_URL; ?>/products">

                            Produk

                        </a>

                    </li>

                    <?php if ($isLoggedIn) : ?>

                        <li class="nav-item">

                            <a
                                class="nav-link <?= $currentSegment === 'cart' ? 'active fw-semibold' : '' ?>"
                                href="<?= BASE_URL; ?>/cart">

                                <i class="bi bi-cart3"></i>

                                Keranjang

                            </a>

                        </li>

                    <?php endif; ?>

                <?php endif; ?>

            </ul>

            <!-- ================================================ -->
            <!-- Right Menu -->
            <!-- ================================================ -->

            <ul class="navbar-nav align-items-lg-center">

                <?php if (!$isLoggedIn) : ?>

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="<?= BASE_URL; ?>/login">

                            <i class="bi bi-box-arrow-in-right"></i>

                            Login

                        </a>

                    </li>

                    <li class="nav-item ms-lg-2">

                        <a
                            class="btn btn-primary"
                            href="<?= BASE_URL; ?>/register">

                            Register

                        </a>

                    </li>

                <?php else : ?>

                    <li class="nav-item dropdown d-none d-lg-block">

                        <a

                            class="nav-link dropdown-toggle"

                            href="#"

                            role="button"

                            data-bs-toggle="dropdown"

                            aria-expanded="false">

                            <i class="bi bi-person-circle"></i>

                            <?= htmlspecialchars($userName); ?>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <?php if ($userRole === 'customer') : ?>

                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL; ?>/profile">

                                        <i class="bi bi-person"></i>

                                        Profil

                                    </a>

                                </li>

                                <li>

                                    <a
                                        class="dropdown-item"
                                        href="<?= BASE_URL; ?>/orders">

                                        <i class="bi bi-receipt"></i>

                                        Pesanan Saya

                                    </a>

                                </li>

                                <li>

                                    <hr class="dropdown-divider">

                                </li>

                            <?php endif; ?>

                            <li>

                                <a
                                    class="dropdown-item text-danger"
                                    href="<?= BASE_URL; ?>/logout">

                                    <i class="bi bi-box-arrow-right"></i>

                                    Logout

                                </a>

                            </li>

                        </ul>

                    </li>

                    <!-- Mobile Menu -->

                    <li class="nav-item d-lg-none mt-3">

                        <span class="fw-semibold">

                            <i class="bi bi-person-circle"></i>

                            <?= htmlspecialchars($userName); ?>

                        </span>

                    </li>

                    <?php if ($userRole === 'customer') : ?>

                        <li class="nav-item d-lg-none">

                            <a
                                class="nav-link"
                                href="<?= BASE_URL; ?>/profile">

                                Profil

                            </a>

                        </li>

                        <li class="nav-item d-lg-none">

                            <a
                                class="nav-link"
                                href="<?= BASE_URL; ?>/orders">

                                Pesanan Saya

                            </a>

                        </li>

                    <?php endif; ?>

                    <li class="nav-item d-lg-none">

                        <a
                            class="nav-link text-danger"
                            href="<?= BASE_URL; ?>/logout">

                            Logout

                        </a>

                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>

</nav>


<div class="container py-4">