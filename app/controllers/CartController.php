<?php

declare(strict_types=1);

class CartController extends Controller
{
    /**
     * Halaman keranjang.
     */
    public function index(): void
    {
        $this->requireLogin();
        $cart = $_SESSION['cart'] ?? [];

        $this->view('cart/index', [

            'cart' => $cart

        ]);
    }

    /**
     * Menambah produk ke keranjang.
     */
    public function add(): void
    {
        /*
        |--------------------------------------------------------------------------
        | User harus login
        |--------------------------------------------------------------------------
        */

        $this->requireLogin();

        /*
        |--------------------------------------------------------------------------
        | Hanya menerima request POST
        |--------------------------------------------------------------------------
        */

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header('Location: ' . BASE_URL . '/products');

            exit;

        }

        /*
        |--------------------------------------------------------------------------
        | Ambil Product ID
        |--------------------------------------------------------------------------
        */

        $productId = (int) ($_POST['product_id'] ?? 0);

        if ($productId <= 0) {

            header('Location: ' . BASE_URL . '/products');

            exit;

        }

        /*
        |--------------------------------------------------------------------------
        | Ambil data produk dari database
        |--------------------------------------------------------------------------
        */

        $productModel = $this->model('ProductModel');

        $product = $productModel->findById($productId);

        if (!$product) {

            die('Produk tidak ditemukan.');

        }

        /*
        |--------------------------------------------------------------------------
        | Cek stok
        |--------------------------------------------------------------------------
        */

        if ($product['stock'] <= 0) {

            die('Produk sedang habis.');

        }

        /*
        |--------------------------------------------------------------------------
        | Inisialisasi cart
        |--------------------------------------------------------------------------
        */

        if (!isset($_SESSION['cart'])) {

            $_SESSION['cart'] = [];

        }

        /*
        |--------------------------------------------------------------------------
        | Produk sudah ada di keranjang
        |--------------------------------------------------------------------------
        */

        if (isset($_SESSION['cart'][$productId])) {

            $qty = $_SESSION['cart'][$productId]['quantity'] + 1;

            /*
            | Jangan melebihi stok
            */

            if ($qty > $product['stock']) {

                $qty = $product['stock'];

            }

            $_SESSION['cart'][$productId]['quantity'] = $qty;

        } else {

            /*
            |--------------------------------------------------------------------------
            | Tambah produk baru
            |--------------------------------------------------------------------------
            */

            $_SESSION['cart'][$productId] = [

                'product_id' => $product['id'],

                'name' => $product['name'],

                'slug' => $product['slug'],

                'price' => $product['price'],

                'image' => $product['image'],

                'stock' => $product['stock'],

                'quantity' => 1

            ];

        }

        /*
        |--------------------------------------------------------------------------
        | Redirect ke halaman keranjang
        |--------------------------------------------------------------------------
        */

        header('Location: ' . BASE_URL . '/cart');

        exit;
    }

    /**
     * Mengubah jumlah produk.
     */
    public function update(): void
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header('Location: ' . BASE_URL . '/cart');

            exit;
        }

        $productId = (int) ($_POST['product_id'] ?? 0);

        $action = $_POST['action'] ?? '';

        if (
            !isset($_SESSION['cart'][$productId])
        ) {

            header('Location: ' . BASE_URL . '/cart');

            exit;
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil stok terbaru dari database
        |--------------------------------------------------------------------------
        */

        $productModel = $this->model('ProductModel');

        $product = $productModel->findById($productId);

        if (!$product) {

            unset($_SESSION['cart'][$productId]);

            header('Location: ' . BASE_URL . '/cart');

            exit;
        }

        $qty = $_SESSION['cart'][$productId]['quantity'];

        /*
        |--------------------------------------------------------------------------
        | Tambah Quantity
        |--------------------------------------------------------------------------
        */

        if ($action === 'increase') {

            if ($qty < $product['stock']) {

                $qty++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Kurangi Quantity
        |--------------------------------------------------------------------------
        */

        if ($action === 'decrease') {

            $qty--;
        }

        /*
        |--------------------------------------------------------------------------
        | Jika Qty <= 0 maka hapus
        |--------------------------------------------------------------------------
        */

        if ($qty <= 0) {

            unset($_SESSION['cart'][$productId]);

        } else {

            $_SESSION['cart'][$productId]['quantity'] = $qty;
        }

        header('Location: ' . BASE_URL . '/cart');

        exit;
    }

    /**
     * Menghapus produk.
     */
    public function remove(): void
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header('Location: ' . BASE_URL . '/cart');

            exit;

        }

        $productId = (int) ($_POST['product_id'] ?? 0);

        if (isset($_SESSION['cart'][$productId])) {

            unset($_SESSION['cart'][$productId]);

        }

        header('Location: ' . BASE_URL . '/cart');

        exit;
    }
}