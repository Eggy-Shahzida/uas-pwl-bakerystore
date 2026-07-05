<?php

/*
|--------------------------------------------------------------------------
| Product Detail View
|--------------------------------------------------------------------------
*/

$title = $product['name'];

require_once APP_PATH . '/views/layouts/header.php';

?>

<!-- ====================================================== -->
<!-- Breadcrumb -->
<!-- ====================================================== -->

<nav class="mb-4">

    <ol class="breadcrumb">

        <li class="breadcrumb-item">

            <a href="<?= BASE_URL; ?>">

                Home

            </a>

        </li>

        <li class="breadcrumb-item">

            <a href="<?= BASE_URL; ?>/products">

                Produk

            </a>

        </li>

        <li class="breadcrumb-item active">

            <?= htmlspecialchars($product['name']); ?>

        </li>

    </ol>

</nav>

<!-- ====================================================== -->
<!-- Detail Produk -->
<!-- ====================================================== -->

<div class="card shadow-sm border-0 mb-5">

    <div class="card-body p-4">

        <div class="row">

            <!-- ============================================ -->
            <!-- Gambar -->
            <!-- ============================================ -->

            <div class="col-lg-5 text-center">

                <?php if (!empty($product['image'])) : ?>

                    <img
                        src="<?= BASE_URL; ?>/uploads/products/<?= htmlspecialchars($product['image']); ?>"
                        class="img-fluid rounded"
                        alt="<?= htmlspecialchars($product['name']); ?>">

                <?php else : ?>

                    <img
                        src="<?= BASE_URL; ?>/assets/images/no-image.png"
                        class="img-fluid rounded"
                        alt="No Image">

                <?php endif; ?>

            </div>

            <!-- ============================================ -->
            <!-- Informasi Produk -->
            <!-- ============================================ -->

            <div class="col-lg-7">

                <span class="badge bg-secondary mb-2">

                    <?= htmlspecialchars($product['category_name']); ?>

                </span>

                <h2 class="fw-bold">

                    <?= htmlspecialchars($product['name']); ?>

                </h2>

                <h3 class="text-primary fw-bold mb-4">

                    Rp <?= number_format($product['price'], 0, ',', '.'); ?>

                </h3>

                <table class="table table-borderless">

                    <tr>

                        <th width="120">

                            Berat

                        </th>

                        <td>

                            <?= number_format($product['weight']); ?> gram

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Stok

                        </th>

                        <td>

                            <?php if ($product['stock'] > 0) : ?>

                                <span class="badge bg-success">

                                    Tersedia (<?= $product['stock']; ?>)

                                </span>

                            <?php else : ?>

                                <span class="badge bg-danger">

                                    Habis

                                </span>

                            <?php endif; ?>

                        </td>

                    </tr>

                </table>

                <div class="d-grid gap-2 mt-4">

                    <?php if ($product['stock'] > 0) : ?>

                        <form
                            action="<?= BASE_URL; ?>/cart/add"
                            method="POST">

                            <input
                                type="hidden"
                                name="product_id"
                                value="<?= $product['id']; ?>">

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg w-100">

                                <i class="bi bi-cart-plus"></i>

                                Tambah ke Keranjang

                            </button>

                        </form>

                    <?php else : ?>

                        <button
                            class="btn btn-secondary btn-lg"
                            disabled>

                            Produk Habis

                        </button>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ====================================================== -->
<!-- Deskripsi -->
<!-- ====================================================== -->

<div class="card shadow-sm border-0 mb-5">

    <div class="card-body p-4">

        <h4 class="fw-bold mb-3">

            Deskripsi Produk

        </h4>

        <p class="mb-0">

            <?= nl2br(htmlspecialchars($product['description'])); ?>

        </p>

    </div>

</div>

<!-- ====================================================== -->
<!-- Produk Terkait -->
<!-- ====================================================== -->

<h3 class="fw-bold mb-4">

    Produk Terkait

</h3>

<div class="row">

    <?php if (empty($relatedProducts)) : ?>

        <div class="col-12">

            <div class="alert alert-light border">

                Tidak ada produk terkait.

            </div>

        </div>

    <?php else : ?>

        <?php foreach ($relatedProducts as $item) : ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                <div class="card h-100 shadow-sm border-0">

                    <?php if (!empty($item['image'])) : ?>

                        <img
                            src="<?= BASE_URL; ?>/uploads/products/<?= htmlspecialchars($item['image']); ?>"
                            class="card-img-top"
                            style="height:200px;object-fit:cover;"
                            alt="<?= htmlspecialchars($item['name']); ?>">

                    <?php else : ?>

                        <img
                            src="<?= BASE_URL; ?>/assets/images/no-image.png"
                            class="card-img-top"
                            style="height:200px;object-fit:cover;"
                            alt="No Image">

                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">

                        <span class="badge bg-light text-dark mb-2">

                            <?= htmlspecialchars($item['category_name']); ?>

                        </span>

                        <h6>

                            <?= htmlspecialchars($item['name']); ?>

                        </h6>

                        <div class="mt-auto">

                            <strong class="text-primary">

                                Rp <?= number_format($item['price'], 0, ',', '.'); ?>

                            </strong>

                        </div>

                    </div>

                    <div class="card-footer bg-white border-0">

                        <a
                            href="<?= BASE_URL; ?>/products/<?= htmlspecialchars($item['slug']); ?>"
                            class="btn btn-outline-primary w-100">

                            Lihat Produk

                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

<?php

require_once APP_PATH . '/views/layouts/footer.php';