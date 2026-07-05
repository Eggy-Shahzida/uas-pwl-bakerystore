<?php

/*
|--------------------------------------------------------------------------
| Cart View
|--------------------------------------------------------------------------
*/

$title = 'Keranjang Belanja';

$totalItem = 0;
$totalPrice = 0;

require_once APP_PATH . '/views/layouts/header.php';

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold mb-1">

            Keranjang Belanja

        </h2>

        <p class="text-muted mb-0">

            Periksa kembali produk yang akan Anda beli.

        </p>

    </div>

    <a
        href="<?= BASE_URL; ?>/products"
        class="btn btn-outline-primary">

        <i class="bi bi-arrow-left"></i>

        Lanjut Belanja

    </a>

</div>

<?php if (empty($cart)) : ?>

    <div class="card shadow-sm border-0">

        <div class="card-body text-center py-5">

            <i
                class="bi bi-cart-x"
                style="font-size:80px;"></i>

            <h4 class="mt-3">

                Keranjang masih kosong

            </h4>

            <p class="text-muted">

                Silakan pilih produk terlebih dahulu.

            </p>

            <a
                href="<?= BASE_URL; ?>/products"
                class="btn btn-primary">

                Belanja Sekarang

            </a>

        </div>

    </div>

<?php else : ?>

    <div class="card shadow-sm border-0">

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>Produk</th>

                        <th width="150">Harga</th>

                        <th width="120">Qty</th>

                        <th width="180">Subtotal</th>

                        <th width="120">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($cart as $item) : ?>

                        <?php

                        $subtotal = $item['price'] * $item['quantity'];

                        $totalItem += $item['quantity'];

                        $totalPrice += $subtotal;

                        ?>

                        <tr>

                            <td>

                                <div class="d-flex align-items-center">

                                    <?php if (!empty($item['image'])) : ?>

                                        <img
                                            src="<?= BASE_URL; ?>/uploads/products/<?= htmlspecialchars($item['image']); ?>"
                                            width="80"
                                            height="80"
                                            class="rounded me-3"
                                            style="object-fit:cover;">

                                    <?php else : ?>

                                        <img
                                            src="<?= BASE_URL; ?>/assets/images/no-image.png"
                                            width="80"
                                            height="80"
                                            class="rounded me-3">

                                    <?php endif; ?>

                                    <div>

                                        <h6 class="mb-1">

                                            <?= htmlspecialchars($item['name']); ?>

                                        </h6>

                                        <small class="text-muted">

                                            Stok tersedia:
                                            <?= $item['stock']; ?>

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>

                                Rp <?= number_format($item['price'], 0, ',', '.'); ?>

                            </td>

                            <td>

                                <form
                                    action="<?= BASE_URL; ?>/cart/update"
                                    method="POST"
                                    class="d-flex align-items-center gap-2">

                                    <input
                                        type="hidden"
                                        name="product_id"
                                        value="<?= $item['product_id']; ?>">

                                    <button
                                        type="submit"
                                        name="action"
                                        value="decrease"
                                        class="btn btn-outline-secondary btn-sm">

                                        <i class="bi bi-dash"></i>

                                    </button>

                                    <span class="fw-bold">

                                        <?= $item['quantity']; ?>

                                    </span>

                                    <button
                                        type="submit"
                                        name="action"
                                        value="increase"
                                        class="btn btn-outline-secondary btn-sm">

                                        <i class="bi bi-plus"></i>

                                    </button>

                                </form>

                            </td>

                            <td>

                                <strong>

                                    Rp <?= number_format($subtotal, 0, ',', '.'); ?>

                                </strong>

                            </td>

                            <td>

                                <form
                                    action="<?= BASE_URL; ?>/cart/remove"
                                    method="POST"
                                    onsubmit="return confirm('Hapus produk dari keranjang?');">

                                    <input
                                        type="hidden"
                                        name="product_id"
                                        value="<?= $item['product_id']; ?>">

                                    <button
                                        type="submit"
                                        class="btn btn-outline-danger btn-sm">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-5 ms-auto">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h5 class="fw-bold mb-3">

                        Ringkasan Belanja

                    </h5>

                    <div class="d-flex justify-content-between mb-2">

                        <span>Total Item</span>

                        <strong>

                            <?= $totalItem; ?>

                        </strong>

                    </div>

                    <div class="d-flex justify-content-between">

                        <span>Total Harga</span>

                        <strong class="text-primary fs-5">

                            Rp <?= number_format($totalPrice, 0, ',', '.'); ?>

                        </strong>

                    </div>

                    <hr>

                    <button
                        class="btn btn-success w-100"
                        disabled>

                        <i class="bi bi-credit-card"></i>

                        Checkout

                    </button>

                </div>

            </div>

        </div>

    </div>

<?php endif; ?>

<?php

require_once APP_PATH . '/views/layouts/footer.php';