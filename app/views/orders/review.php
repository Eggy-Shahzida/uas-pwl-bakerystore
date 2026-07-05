<?php

/*
|--------------------------------------------------------------------------
| Review Order View
|--------------------------------------------------------------------------
| Halaman terakhir sebelum pesanan disimpan ke database.
*/

$title = 'Review Pesanan';

require_once APP_PATH . '/views/layouts/header.php';

?>

<div class="row">

    <!-- ====================================================== -->
    <!-- Informasi Pesanan -->
    <!-- ====================================================== -->

    <div class="col-lg-8">

        <!-- Data Penerima -->

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body">

                <h4 class="fw-bold mb-3">

                    Data Penerima

                </h4>

                <table class="table table-borderless mb-0">

                    <tr>

                        <th width="180">

                            Nama

                        </th>

                        <td>

                            <?= htmlspecialchars($checkout['recipient_name']); ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Nomor HP

                        </th>

                        <td>

                            <?= htmlspecialchars($checkout['recipient_phone']); ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Alamat

                        </th>

                        <td>

                            <?= nl2br(htmlspecialchars($checkout['shipping_address'])); ?>

                        </td>

                    </tr>

                    <?php if (!empty($checkout['note'])) : ?>

                        <tr>

                            <th>

                                Catatan

                            </th>

                            <td>

                                <?= htmlspecialchars($checkout['note']); ?>

                            </td>

                        </tr>

                    <?php endif; ?>

                </table>

            </div>

        </div>

        <!-- Metode Pengiriman -->

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body">

                <h4 class="fw-bold mb-3">

                    Pengiriman

                </h4>

                <table class="table table-borderless mb-0">

                    <tr>

                        <th width="180">

                            Metode

                        </th>

                        <td>

                            <?= ucwords(str_replace('_', ' ', $shipping['method'])); ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Biaya

                        </th>

                        <td>

                            Rp <?= number_format($shippingCost, 0, ',', '.'); ?>

                        </td>

                    </tr>

                </table>

            </div>

        </div>

        <!-- Produk -->

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <h4 class="fw-bold mb-4">

                    Produk

                </h4>

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>

                                    Produk

                                </th>

                                <th class="text-center">

                                    Qty

                                </th>

                                <th class="text-end">

                                    Harga

                                </th>

                                <th class="text-end">

                                    Subtotal

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($cart as $item) : ?>

                                <tr>

                                    <td>

                                        <?= htmlspecialchars($item['name']); ?>

                                    </td>

                                    <td class="text-center">

                                        <?= $item['quantity']; ?>

                                    </td>

                                    <td class="text-end">

                                        Rp <?= number_format($item['price'], 0, ',', '.'); ?>

                                    </td>

                                    <td class="text-end">

                                        Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- ====================================================== -->
    <!-- Ringkasan -->
    <!-- ====================================================== -->

    <div class="col-lg-4">

        <div class="card shadow-sm border-0 sticky-top">

            <div class="card-body">

                <h4 class="fw-bold mb-4">

                    Ringkasan Pembayaran

                </h4>

                <div class="d-flex justify-content-between mb-2">

                    <span>

                        Subtotal

                    </span>

                    <strong>

                        Rp <?= number_format($subtotal, 0, ',', '.'); ?>

                    </strong>

                </div>

                <div class="d-flex justify-content-between mb-2">

                    <span>

                        Ongkir

                    </span>

                    <strong>

                        Rp <?= number_format($shippingCost, 0, ',', '.'); ?>

                    </strong>

                </div>

                <hr>

                <div class="d-flex justify-content-between mb-4">

                    <h5>

                        Total

                    </h5>

                    <h5 class="text-success">

                        Rp <?= number_format($grandTotal, 0, ',', '.'); ?>

                    </h5>

                </div>

                <form
                    action="<?= BASE_URL; ?>/checkout/review"
                    method="POST">

                    <button
                        type="submit"
                        class="btn btn-success btn-lg w-100">

                        <i class="bi bi-check-circle"></i>

                        Buat Pesanan

                    </button>

                </form>

                <a
                    href="<?= BASE_URL; ?>/checkout/shipping"
                    class="btn btn-outline-secondary w-100 mt-3">

                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>

<?php

require_once APP_PATH . '/views/layouts/footer.php';