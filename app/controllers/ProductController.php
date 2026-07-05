<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Product Controller
|--------------------------------------------------------------------------
| Controller ini bertugas menangani seluruh halaman yang berkaitan
| dengan produk, seperti daftar produk dan detail produk.
|--------------------------------------------------------------------------
*/

class ProductController extends Controller
{
    /**
     * Menampilkan seluruh produk.
     */
    public function index(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Memuat Model
        |--------------------------------------------------------------------------
        */

        $productModel = $this->model('ProductModel');

        $categoryModel = $this->model('CategoryModel');

        $categoryId = null;

        if (isset($_GET['category']) && $_GET['category'] !== '') {
            $categoryId = (int) $_GET['category'];
        }

        $keyword = '';

        if (isset($_GET['search'])) {
            $keyword = trim($_GET['search']);
        }


        /*
        |--------------------------------------------------------------------------
        | Mengambil Data
        |--------------------------------------------------------------------------
        */

        //$products = $productModel->getAll();
        $products = $productModel->filter(
            $categoryId,
            $keyword
        );

        $categories = $categoryModel->getAll();

        

        /*
        |--------------------------------------------------------------------------
        | Menampilkan View
        |--------------------------------------------------------------------------
        */

        $this->view('products/index', [

            'products' => $products,

            'categories' => $categories,

            'categoryId' => $categoryId,

            'keyword' => $keyword

        ]);
    }

    /**
     * Menampilkan detail produk berdasarkan slug.
     *
     * URL:
     * /products/{slug}
     */
    public function show(string $slug): void
    {
        /*
        |--------------------------------------------------------------------------
        | Load Model
        |--------------------------------------------------------------------------
        */

        $productModel = $this->model('ProductModel');

        /*
        |--------------------------------------------------------------------------
        | Ambil Data Produk
        |--------------------------------------------------------------------------
        */

        $product = $productModel->findBySlug($slug);

        /*
        |--------------------------------------------------------------------------
        | Jika produk tidak ditemukan
        |--------------------------------------------------------------------------
        */

        if (!$product) {

            http_response_code(404);

            die('Produk tidak ditemukan.');

        }

        /*
        |--------------------------------------------------------------------------
        | Ambil Produk Terkait
        |--------------------------------------------------------------------------
        */

        $relatedProducts = $productModel->getRelatedProducts(
            (int) $product['category_id'],
            (int) $product['id'],
            4
        );

        /*
        |--------------------------------------------------------------------------
        | Tampilkan View
        |--------------------------------------------------------------------------
        */

        $this->view('products/show', [

            'product' => $product,

            'relatedProducts' => $relatedProducts

        ]);
    }
    
}