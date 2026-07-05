<?php

/*
|--------------------------------------------------------------------------
| Shipping View
|--------------------------------------------------------------------------
| Halaman memilih metode pengiriman.
*/

$title = 'Pilih Pengiriman';

require_once APP_PATH . '/views/layouts/header.php';

/*
|--------------------------------------------------------------------------
| Hitung Total Belanja
|--------------------------------------------------------------------------
*/

$subtotal = 0;

foreach ($cart as $item) {

    $subtotal += $item['price'] * $item['quantity'];
}

?>

<div class="row">

    <!-- ====================================================== -->
    <!-- Pilihan Pengiriman -->
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

        <!-- Pilihan Kurir -->

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <h4 class="fw-bold mb-4">

                    Pilih Metode Pengiriman

                </h4>

                <form
                    action="<?= BASE_URL; ?>/checkout/shipping"
                    method="POST">

                    <?php foreach ($shippingMethods as $method) : ?>

                        <div class="form-check border rounded p-3 mb-3">

                            <input
                                class="form-check-input"
                                type="radio"
                                name="shipping_method"
                                id="<?= $method['code']; ?>"
                                value="<?= $method['code']; ?>"
                                data-cost="<?= $method['cost']; ?>"
                                <?= $method === reset($shippingMethods) ? 'checked' : ''; ?>>

                            <label
                                class="form-check-label w-100"
                                for="<?= $method['code']; ?>">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <strong>

                                            <?= htmlspecialchars($method['name']); ?>

                                        </strong>

                                        <br>

                                        <small class="text-muted">

                                            <?= htmlspecialchars($method['description']); ?>

                                        </small>

                                    </div>

                                    <div class="fw-bold text-primary">

                                        Rp <?= number_format($method['cost'], 0, ',', '.'); ?>

                                    </div>

                                </div>

                            </label>

                        </div>

                    <?php endforeach; ?>

                    <button
                        type="submit"
                        class="btn btn-success btn-lg">

                        Lanjut Review Pesanan

                    </button>

                </form>

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

                    Ringkasan Belanja

                </h4>

                <?php foreach ($cart as $item) : ?>

                    <div class="d-flex justify-content-between mb-2">

                        <div>

                            <?= htmlspecialchars($item['name']); ?>

                            <br>

                            <small class="text-muted">

                                <?= $item['quantity']; ?> x
                                Rp <?= number_format($item['price'], 0, ',', '.'); ?>

                            </small>

                        </div>

                        <strong>

                            Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>

                        </strong>

                    </div>

                <?php endforeach; ?>

                <hr>

                <div class="d-flex justify-content-between">

                    <span>Subtotal</span>

                    <strong>

                        Rp <?= number_format($subtotal, 0, ',', '.'); ?>

                    </strong>

                </div>

                <div class="d-flex justify-content-between mt-2">

                    <span>Ongkir</span>

                    <strong id="shipping-cost">

                        Rp <?= number_format($shippingMethods[0]['cost'], 0, ',', '.'); ?>

                    </strong>

                </div>

                <hr>

                <div class="d-flex justify-content-between">

                    <h5>Total</h5>

                    <h5
                        class="text-success"
                        id="grand-total"
                        data-subtotal="<?= $subtotal; ?>">

                        Rp <?= number_format($subtotal + $shippingMethods[0]['cost'], 0, ',', '.'); ?>

                    </h5>

                </div>

            </div>

        </div>

    </div>

</div>

<?php

$scripts = [

    'shipping.js'

];

require_once APP_PATH . '/views/layouts/footer.php';