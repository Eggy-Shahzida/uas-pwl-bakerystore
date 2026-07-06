<?php

declare(strict_types=1);

require_once APP_PATH . '/services/ShippingService.php';


/*
|--------------------------------------------------------------------------
| Order Controller
|--------------------------------------------------------------------------
| Mengelola proses checkout pelanggan.
*/

class OrderController extends Controller
{
    /**
     * Service RajaOngkir.
     */
    private ShippingService $shippingService;

    public function __construct()
    {
        $this->shippingService = new ShippingService();
    }

    /**
     * Menampilkan halaman checkout.
     */
    public function checkout(): void
    {
        $this->requireLogin();

        /*
        |--------------------------------------------------------------------------
        | Keranjang kosong
        |--------------------------------------------------------------------------
        */

        if (empty($_SESSION['cart'])) {

            header('Location: ' . BASE_URL . '/cart');

            exit;
        }

        /*
        |--------------------------------------------------------------------------
        | Tampilkan halaman checkout
        |--------------------------------------------------------------------------
        */

        $this->view('orders/checkout', [

            'cart' => $_SESSION['cart']

        ]);
    }

    /**
     * Memproses data checkout.
     */
    public function processCheckout(): void
    {
        $this->requireLogin();

        /*
        |--------------------------------------------------------------------------
        | Keranjang kosong
        |--------------------------------------------------------------------------
        */

        if (empty($_SESSION['cart'])) {

            header('Location: ' . BASE_URL . '/cart');

            exit;
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil data dari form
        |--------------------------------------------------------------------------
        */

        $recipientName = trim($_POST['recipient_name'] ?? '');

        $recipientPhone = trim($_POST['recipient_phone'] ?? '');

        $shippingAddress = trim($_POST['shipping_address'] ?? '');

        $note = trim($_POST['note'] ?? '');

        $errors = [];

        /*
        |--------------------------------------------------------------------------
        | Validasi Nama Penerima
        |--------------------------------------------------------------------------
        */

        if ($recipientName === '') {

            $errors['recipient_name'] = 'Nama penerima wajib diisi.';

        } elseif (mb_strlen($recipientName) < 3) {

            $errors['recipient_name'] =
                'Nama penerima minimal 3 karakter.';

        } elseif (mb_strlen($recipientName) > 100) {

            $errors['recipient_name'] =
                'Nama penerima maksimal 100 karakter.';

        } elseif (!preg_match('/^[A-Za-z\s]+$/', $recipientName)) {

            $errors['recipient_name'] =
                'Nama penerima hanya boleh berisi huruf dan spasi.';
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi Nomor HP
        |--------------------------------------------------------------------------
        */

        if ($recipientPhone === '') {

            $errors['recipient_phone'] =
                'Nomor HP wajib diisi.';

        } elseif (!preg_match('/^[0-9]+$/', $recipientPhone)) {

            $errors['recipient_phone'] =
                'Nomor HP hanya boleh terdiri dari angka.';

        } elseif (strlen($recipientPhone) < 10) {

            $errors['recipient_phone'] =
                'Nomor HP minimal 10 digit.';

        } elseif (strlen($recipientPhone) > 13) {

            $errors['recipient_phone'] =
                'Nomor HP maksimal 13 digit.';

        } elseif (!preg_match('/^08[0-9]{8,11}$/', $recipientPhone)) {

            $errors['recipient_phone'] =
                'Format nomor HP tidak valid.';
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi Alamat
        |--------------------------------------------------------------------------
        */

        if ($shippingAddress === '') {

            $errors['shipping_address'] =
                'Alamat pengiriman wajib diisi.';

        } elseif (mb_strlen($shippingAddress) < 10) {

            $errors['shipping_address'] =
                'Alamat minimal terdiri dari 10 karakter.';

        } elseif (mb_strlen($shippingAddress) > 255) {

            $errors['shipping_address'] =
                'Alamat maksimal 255 karakter.';
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi Catatan
        |--------------------------------------------------------------------------
        */

        if (mb_strlen($note) > 255) {

            $errors['note'] =
                'Catatan maksimal 255 karakter.';
        }

        /*
        |--------------------------------------------------------------------------
        | Jika gagal
        |--------------------------------------------------------------------------
        */

        if (!empty($errors)) {

            $this->view('orders/checkout', [

                'cart' => $_SESSION['cart'],

                'errors' => $errors,

                'old' => $_POST

            ]);

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan sementara ke Session
        |--------------------------------------------------------------------------
        */

        $_SESSION['checkout'] = [

            'recipient_name' => $recipientName,

            'recipient_phone' => $recipientPhone,

            'shipping_address' => $shippingAddress,

            'note' => $note

        ];

        /*
        |--------------------------------------------------------------------------
        | Lanjut ke halaman pengiriman
        |--------------------------------------------------------------------------
        */

        header('Location: ' . BASE_URL . '/checkout/review');

        exit;
    }

    /**
     * Halaman Pilih Pengiriman.
     */
    public function shipping(): void
    {
        $this->requireLogin();

        /*
        |--------------------------------------------------------------------------
        | Pastikan data checkout sudah diisi
        |--------------------------------------------------------------------------
        */

        if (empty($_SESSION['checkout'])) {

            header('Location: ' . BASE_URL . '/checkout');

            exit;
        }

        /*
        |--------------------------------------------------------------------------
        | Pastikan keranjang masih ada
        |--------------------------------------------------------------------------
        */

        if (empty($_SESSION['cart'])) {

            header('Location: ' . BASE_URL . '/cart');

            exit;
        }

        /*
        |--------------------------------------------------------------------------
        | Dummy Data Pengiriman
        |--------------------------------------------------------------------------
        */

        $shippingMethods = [

            [
                'code' => 'regular',
                'name' => 'Regular',
                'description' => 'Estimasi 2 - 4 Hari',
                'cost' => 15000
            ],

            [
                'code' => 'express',
                'name' => 'Express',
                'description' => 'Estimasi 1 Hari',
                'cost' => 25000
            ],

            [
                'code' => 'same_day',
                'name' => 'Same Day',
                'description' => 'Dikirim Hari Ini',
                'cost' => 40000
            ]

        ];

        $this->view('orders/shipping', [

            'cart' => $_SESSION['cart'],

            'checkout' => $_SESSION['checkout'],

            'shippingMethods' => $shippingMethods

        ]);
    }

    /**
     * Memproses pilihan pengiriman.
     */
    public function processShipping(): void
    {
        $this->requireLogin();

        if (empty($_POST['shipping_method'])) {

            header('Location: ' . BASE_URL . '/checkout/shipping');

            exit;
        }

        $_SESSION['shipping'] = [

            'method' => $_POST['shipping_method']

        ];

        /*
        |--------------------------------------------------------------------------
        | Tahap berikutnya
        |--------------------------------------------------------------------------
        */

        header('Location: ' . BASE_URL . '/checkout/review');

        exit;
    }

    /**
     * Review Pesanan.
     */
    public function review(): void
    {
        $this->requireLogin();

        /*
        |--------------------------------------------------------------------------
        | Pastikan seluruh proses checkout sudah selesai
        |--------------------------------------------------------------------------
        */

        if (
            empty($_SESSION['checkout']) ||
            empty($_SESSION['shipping']) ||
            empty($_SESSION['cart'])
        ) {

            header('Location: ' . BASE_URL . '/cart');

            exit;
        }

        /*
        |--------------------------------------------------------------------------
        | Dummy biaya ongkir
        |--------------------------------------------------------------------------
        */

        $shippingCost = match ($_SESSION['shipping']['method']) {

            'regular' => 15000,

            'express' => 25000,

            'same_day' => 40000,

            default => 0
        };

        $subtotal = 0;

        foreach ($_SESSION['cart'] as $item) {

            $subtotal +=
                $item['price'] *
                $item['quantity'];
        }

        $grandTotal =

            $subtotal +

            $shippingCost;

        $this->view(

            'orders/review',

            [

                'cart' => $_SESSION['cart'],

                'checkout' => $_SESSION['checkout'],

                'shipping' => $_SESSION['shipping'],

                'subtotal' => $subtotal,

                'shippingCost' => $shippingCost,

                'grandTotal' => $grandTotal

            ]

        );

        
    }

    /**
     * Menyimpan Order.
     */
    public function placeOrder(): void
    {
        $this->requireLogin();

        /*
        |--------------------------------------------------------------------------
        | Nanti akan disimpan ke database.
        |--------------------------------------------------------------------------
        */

        echo "<pre>";

        print_r($_SESSION);

        echo "</pre>";
    }

    /**
     * Mengambil seluruh provinsi.
     */
    public function getProvinces(): void
    {
        header('Content-Type: application/json');

        try {

            $result = $this->shippingService
                ->getProvinces();

            echo json_encode($result);

        } catch (Exception $e) {

            http_response_code(500);

            echo json_encode([

                'success' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    /**
     * Mengambil kota berdasarkan provinsi.
     */
    public function getCities(): void
    {
        header('Content-Type: application/json');

        $provinceId = $_GET['province_id'] ?? '';

        if ($provinceId === '') {

            echo json_encode([]);

            return;
        }

        try {

            $result = $this->shippingService
                ->getCities($provinceId);

            echo json_encode($result);

        } catch (Exception $e) {

            http_response_code(500);

            echo json_encode([

                'success' => false,

                'message' => $e->getMessage()

            ]);
        }
    }

    /**
     * Mengambil layanan pengiriman.
     */
    public function getServices(): void
    {
        header('Content-Type: application/json');

        $destination = $_GET['destination'] ?? '';

        $courier = $_GET['courier'] ?? '';

        if ($destination === '' || $courier === '') {

            echo json_encode([]);

            return;
        }

        try {

            $result = $this->shippingService
                ->calculateCost(

                    $destination,

                    STORE_WEIGHT_DEFAULT,

                    $courier

                );

            echo json_encode($result);

        } catch (Exception $e) {

            http_response_code(500);

            echo json_encode([

                'success' => false,

                'message' => $e->getMessage()

            ]);
        }
    }
}