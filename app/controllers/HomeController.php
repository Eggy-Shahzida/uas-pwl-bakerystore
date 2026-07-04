<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Home Controller
|--------------------------------------------------------------------------
| Controller pertama pada aplikasi.
| Bertugas menampilkan halaman utama (Home).
*/

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama.
     */
    public function index(): void
    {
        echo '<pre>';

        print_r($_SESSION);

        echo '</pre>';
        $this->view('home/index');
    }
}