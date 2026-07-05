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

<div class="row">

    <?php foreach ($categories as $category) : ?>

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body text-center">

                    <div class="display-5 mb-3">

                        🍞

                    </div>

                    <h5>

                        <?= htmlspecialchars($category['name']); ?>

                    </h5>

                </div>

            </div>

        </div>

    <?php endforeach; ?>

</div>

<!-- Produk -->

<h3 class="fw-bold mb-4">

    Produk Terbaru

</h3>

<div class="row">

    <?php foreach ($products as $product) : ?>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <img
                    src="<?= BASE_URL; ?>/assets/images/no-image.png"
                    class="card-img-top"
                    alt="<?= htmlspecialchars($product['name']); ?>">

                <div class="card-body">

                    <small class="text-muted">

                        <?= htmlspecialchars($product['category_name']); ?>

                    </small>

                    <h5 class="mt-2">

                        <?= htmlspecialchars($product['name']); ?>

                    </h5>

                    <p class="fw-bold text-primary mb-1">

                        Rp <?= number_format($product['price'], 0, ',', '.'); ?>

                    </p>

                    <small class="text-muted">

                        Stok :

                        <?= $product['stock']; ?>

                    </small>

                </div>

                <div class="card-footer bg-white border-0">

                    <a
                        href="#"
                        class="btn btn-outline-primary w-100">

                        Lihat Detail

                    </a>

                </div>

            </div>

        </div>

    <?php endforeach; ?>

</div>

<?php

require_once APP_PATH . '/views/layouts/footer.php';

?>