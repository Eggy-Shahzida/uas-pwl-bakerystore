<?php

/*
|--------------------------------------------------------------------------
| Product List View
|--------------------------------------------------------------------------
*/

$title = 'Produk';

require_once APP_PATH . '/views/layouts/header.php';

?>

<!-- Header -->

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">

    <div class="row align-items-center">

        <div class="col-md-8">

            <h2 class="fw-bold mb-2">

                Semua Produk

            </h2>

            <p class="text-muted mb-0">

                Temukan berbagai pilihan roti, pastry, dan cake yang selalu
                fresh setiap hari.

            </p>

        </div>

        <div class="col-md-4">

            <form
                action="<?= BASE_URL; ?>/products"
                method="GET">

                <?php if (!empty($categoryId)) : ?>

                    <input
                        type="hidden"
                        name="category"
                        value="<?= $categoryId; ?>">

                <?php endif; ?>

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari produk..."
                    value="<?= htmlspecialchars($keyword ?? ''); ?>">

            </form>

        </div>

    </div>

</div>

<!-- Filter Kategori -->

<div class="mb-4">

    <div class="d-flex flex-wrap gap-2">

        <!-- Tombol Semua -->

        <a
            href="<?= BASE_URL; ?>/products<?= !empty($keyword) ? '?search=' . urlencode($keyword) : ''; ?>"
            class="btn <?= empty($categoryId) ? 'btn-primary' : 'btn-outline-primary'; ?>">

            Semua

        </a>

        <?php foreach ($categories as $category) : ?>

            <?php

            $url = BASE_URL . '/products?category=' . $category['id'];

            if (!empty($keyword)) {
                $url .= '&search=' . urlencode($keyword);
            }

            ?>

            <a
                href="<?= $url; ?>"
                class="btn <?= ($categoryId == $category['id']) ? 'btn-primary' : 'btn-outline-primary'; ?>">

                <?= htmlspecialchars($category['name']); ?>

            </a>

        <?php endforeach; ?>

    </div>

</div>

<!-- Daftar Produk -->

<div class="row">

    <?php if (empty($products)) : ?>

        <div class="col-12">

            <div class="alert alert-warning">

                Belum ada produk.

            </div>

        </div>

    <?php else : ?>

        <?php foreach ($products as $product) : ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                <div class="card h-100 shadow-sm border-0">

                    <!-- Gambar -->

                    <?php if (!empty($product['image'])) : ?>

                        <img
                            src="<?= BASE_URL; ?>/uploads/products/<?= htmlspecialchars($product['image']); ?>"
                            class="card-img-top"
                            style="height:220px;object-fit:cover;"
                            alt="<?= htmlspecialchars($product['name']); ?>">

                    <?php else : ?>

                        <img
                            src="<?= BASE_URL; ?>/assets/images/no-image.png"
                            class="card-img-top"
                            style="height:220px;object-fit:cover;"
                            alt="No Image">

                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">

                        <span class="badge bg-light text-dark mb-2">

                            <?= htmlspecialchars($product['category_name']); ?>

                        </span>

                        <h5 class="card-title">

                            <?= htmlspecialchars($product['name']); ?>

                        </h5>

                        <p class="text-muted small mb-2">

                            <?= mb_strimwidth(strip_tags($product['description'] ?? ''), 0, 80, '...'); ?>

                        </p>

                        <div class="mt-auto">

                            <h5 class="text-primary fw-bold">

                                Rp <?= number_format($product['price'], 0, ',', '.'); ?>

                            </h5>

                            <small class="text-muted">

                                Stok :
                                <?= $product['stock']; ?>

                            </small>

                        </div>

                    </div>

                    <div class="card-footer bg-white border-0">

                        <a
                            href="<?= BASE_URL; ?>/products/<?= htmlspecialchars($product['slug']); ?>"
                            class="btn btn-outline-primary w-100">

                            Detail Produk

                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

<?php

require_once APP_PATH . '/views/layouts/footer.php';