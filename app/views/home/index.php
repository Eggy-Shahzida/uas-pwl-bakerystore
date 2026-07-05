<?php

/*
|--------------------------------------------------------------------------
| Home View
|--------------------------------------------------------------------------
*/

$title = 'Beranda';

require_once APP_PATH . '/views/layouts/header.php';

?>

<!-- Hero -->

<div class="p-5 mb-5 bg-white rounded-4 shadow-sm">

    <div class="row align-items-center">

        <div class="col-lg-7">

            <h1 class="display-5 fw-bold">

                🍞 Fresh Bread Every Day

            </h1>

            <p class="lead text-muted">

                Nikmati berbagai pilihan roti, pastry, dan cake
                dengan bahan berkualitas dan selalu fresh setiap hari.

            </p>

            <a
                href="<?= BASE_URL; ?>/products"
                class="btn btn-primary btn-lg">

                Lihat Produk

            </a>

        </div>

        <div class="col-lg-5 text-center mt-4 mt-lg-0">

            <i
                class="bi bi-basket2-fill"
                style="font-size: 9rem;color:#f59e0b;">

            </i>

        </div>

    </div>

</div>

<!-- Search -->

<div class="mb-5">

    <input
        type="text"
        class="form-control form-control-lg"
        placeholder="Cari roti favorit Anda...">

</div>

<!-- Kategori -->

<h3 class="fw-bold mb-4">

    Kategori

</h3>

<div class="row text-center mb-5">

    <div class="col-md-4 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="display-4">

                    🥖

                </div>

                <h5>

                    Bread

                </h5>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="display-4">

                    🥐

                </div>

                <h5>

                    Pastry

                </h5>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="display-4">

                    🎂

                </div>

                <h5>

                    Cake

                </h5>

            </div>

        </div>

    </div>

</div>

<!-- Produk -->

<h3 class="fw-bold mb-4">

    Produk Terbaru

</h3>

<div class="row">
    <?php

$products = [

    [
        'name' => 'Roti Coklat',
        'price' => 15000,
        'category' => 'Bread',
        'image' => 'https://placehold.co/600x400?text=Roti+Coklat'
    ],

    [
        'name' => 'Croissant Butter',
        'price' => 18000,
        'category' => 'Pastry',
        'image' => 'https://placehold.co/600x400?text=Croissant'
    ],

    [
        'name' => 'Cheese Cake',
        'price' => 35000,
        'category' => 'Cake',
        'image' => 'https://placehold.co/600x400?text=Cheese+Cake'
    ],

    [
        'name' => 'Donat Strawberry',
        'price' => 12000,
        'category' => 'Bread',
        'image' => 'https://placehold.co/600x400?text=Donat'
    ]

];

foreach ($products as $product) :

?>

<div class="col-lg-3 col-md-6 mb-4">

    <div class="card border-0 shadow-sm h-100">

        <img
            src="<?= $product['image']; ?>"
            class="card-img-top"
            alt="<?= htmlspecialchars($product['name']); ?>">

        <div class="card-body d-flex flex-column">

            <span class="badge bg-warning text-dark align-self-start mb-2">

                <?= $product['category']; ?>

            </span>

            <h5 class="card-title">

                <?= htmlspecialchars($product['name']); ?>

            </h5>

            <p class="text-success fw-bold fs-5">

                Rp <?= number_format($product['price'], 0, ',', '.'); ?>

            </p>

            <div class="mt-auto d-grid gap-2">

                <button
                    class="btn btn-outline-primary">

                    <i class="bi bi-eye"></i>

                    Detail

                </button>

                <button
                    class="btn btn-primary">

                    <i class="bi bi-cart-plus"></i>

                    Tambah ke Keranjang

                </button>

            </div>

        </div>

    </div>

</div>

<?php endforeach; ?>

</div>

<?php

require_once APP_PATH . '/views/layouts/footer.php';

?>