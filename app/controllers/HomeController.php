<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Home Controller
|--------------------------------------------------------------------------
| Controller ini bertugas menampilkan halaman utama BreadShop.
| Data yang ditampilkan berasal dari database melalui Model.
|--------------------------------------------------------------------------
*/

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda.
     */
    public function index(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Memuat Model
        |--------------------------------------------------------------------------
        */

        $categoryModel = $this->model('CategoryModel');

        $productModel = $this->model('ProductModel');

        /*
        |--------------------------------------------------------------------------
        | Mengambil Data
        |--------------------------------------------------------------------------
        */

        $categories = $categoryModel->getAll();

        $products = $productModel->latest(8);

        /*
        |--------------------------------------------------------------------------
        | Mengirim Data ke View
        |--------------------------------------------------------------------------
        */

        $this->view('home/index', [

            'title' => 'Beranda',

            'categories' => $categories,

            'products' => $products

        ]);
    }
}