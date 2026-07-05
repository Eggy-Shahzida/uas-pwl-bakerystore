<?php

/*
|--------------------------------------------------------------------------
| Checkout View
|--------------------------------------------------------------------------
*/

$title = 'Checkout';

$errors = $errors ?? [];

$old = $old ?? [];

$scripts = [
    'checkout.js'
];

$totalItem = 0;
$totalPrice = 0;

require_once APP_PATH . '/views/layouts/header.php';

?>

<div class="row">

    <!-- ====================================================== -->
    <!-- Form Checkout -->
    <!-- ====================================================== -->

    <div class="col-lg-8">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <h3 class="fw-bold mb-4">

                    Data Penerima

                </h3>

                <form
                    action="<?= BASE_URL; ?>/checkout"
                    method="POST"
                    novalidate>

                    <!-- ====================================================== -->
                    <!-- Nama Penerima -->
                    <!-- ====================================================== -->

                    <div class="mb-3">

                        <label
                            for="recipient_name"
                            class="form-label">

                            Nama Penerima

                        </label>

                        <input
                            id="recipient_name"
                            type="text"
                            name="recipient_name"
                            class="form-control <?= !empty($errors['recipient_name']) ? 'is-invalid' : ''; ?>"
                            maxlength="100"
                            autocomplete="name"
                            value="<?= htmlspecialchars($old['recipient_name'] ?? ''); ?>"
                            required>

                        <?php if (!empty($errors['recipient_name'])) : ?>

                            <div class="invalid-feedback">

                                <?= $errors['recipient_name']; ?>

                            </div>

                        <?php endif; ?>

                        <small
                            id="recipient-name-info"
                            class="text-danger d-block mt-1">

                        </small>

                        <?php if (!empty($errors['note'])) : ?>

                            <div class="text-danger mt-1">

                                <?= $errors['note']; ?>

                            </div>

                        <?php endif; ?>

                    </div>

                    <!-- ====================================================== -->
                    <!-- Nomor HP -->
                    <!-- ====================================================== -->

                    <div class="mb-3">

                        <label
                            for="recipient_phone"
                            class="form-label">

                            Nomor HP

                        </label>

                        <input
                            id="recipient_phone"
                            type="tel"
                            name="recipient_phone"
                            class="form-control <?= !empty($errors['recipient_phone']) ? 'is-invalid' : ''; ?>"
                            maxlength="13"
                            minlength="10"
                            inputmode="numeric"
                            autocomplete="tel"
                            placeholder="08xxxxxxxxxx"
                            value="<?= htmlspecialchars($old['recipient_phone'] ?? ''); ?>"
                            required>

                        <?php if (!empty($errors['recipient_phone'])) : ?>

                            <div class="invalid-feedback">

                                <?= $errors['recipient_phone']; ?>

                            </div>

                        <?php endif; ?>

                        <small
                            id="recipient-phone-info"
                            class="text-danger d-block mt-1">

                        </small>

                    </div>

                    <!-- ====================================================== -->
                    <!-- Provinsi -->
                    <!-- ====================================================== -->

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Provinsi

                        </label>

                        <select
                            class="form-select"
                            id="province"
                            name="province_code"
                            required>

                            <option value="">

                                -- Pilih Provinsi --

                            </option>

                            <?php foreach ($provinces as $province) : ?>

                                <option
                                    value="<?= $province['id']; ?>">

                                    <?= htmlspecialchars($province['name']); ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                        <div class="invalid-feedback">

                            Provinsi wajib dipilih.

                        </div>

                    </div>

                    <!-- ====================================================== -->
                    <!-- Kota -->
                    <!-- ====================================================== -->

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Kota / Kabupaten

                        </label>

                        <select
                            class="form-select"
                            id="city"
                            name="city_code"
                            required
                            disabled>

                            <option value="">

                                -- Pilih Kota --

                            </option>

                        </select>

                        <div class="invalid-feedback">

                            Kota wajib dipilih.

                        </div>

                    </div>

                    <!-- ====================================================== -->
                    <!-- Kode Pos -->
                    <!-- ====================================================== -->

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Kode Pos

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="postal_code"
                            name="postal_code"
                            maxlength="5"
                            inputmode="numeric"
                            placeholder="Contoh: 50131"
                            value="<?= htmlspecialchars($old['postal_code'] ?? ''); ?>"
                            required>

                    </div>

                    <!-- ====================================================== -->
                    <!-- Alamat -->
                    <!-- ====================================================== -->

                    <div class="mb-3">

                        <label
                            for="shipping_address"
                            class="form-label">

                            Alamat Lengkap

                        </label>

                        <textarea
                            id="shipping_address"
                            name="shipping_address"
                            class="form-control <?= !empty($errors['shipping_address']) ? 'is-invalid' : ''; ?>"
                            rows="5"
                            maxlength="255"
                            minlength="10"
                            required><?= htmlspecialchars($old['shipping_address'] ?? ''); ?></textarea>

                        <?php if (!empty($errors['shipping_address'])) : ?>

                            <div class="invalid-feedback">

                                <?= $errors['shipping_address']; ?>

                            </div>

                        <?php endif; ?>

                        <small
                            id="shipping-address-info"
                            class="text-danger d-block mt-1">

                        </small>

                    </div>

                    <!-- ====================================================== -->
                    <!-- Kurir -->
                    <!-- ====================================================== -->

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Kurir

                        </label>

                        <select
                            class="form-select"
                            id="courier"
                            name="courier"
                            required>

                            <option value="">

                                -- Pilih Kurir --

                            </option>

                            <option value="jne">

                                JNE

                            </option>

                            <option value="pos">

                                POS Indonesia

                            </option>

                            <option value="tiki">

                                TIKI

                            </option>

                        </select>

                    </div>

                    <!-- ====================================================== -->
                    <!-- Layanan -->
                    <!-- ====================================================== -->

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Layanan Pengiriman

                        </label>

                        <select
                            class="form-select"
                            id="service"
                            name="service"
                            required
                            disabled>

                            <option value="">

                                -- Pilih Layanan --

                            </option>

                        </select>

                    </div>

                    <!-- ====================================================== -->
                    <!-- Catatan -->
                    <!-- ====================================================== -->

                    <div class="mb-4">

                        <label
                            for="note"
                            class="form-label">

                            Catatan (Opsional)

                        </label>

                        <textarea
                            id="note"
                            name="note"
                            class="form-control"
                            rows="3"
                            maxlength="255"><?= htmlspecialchars($old['note'] ?? ''); ?></textarea>

                        <small
                            id="note-counter"
                            class="text-muted">

                            0 / 255 karakter

                        </small>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-success btn-lg">

                        <i class="bi bi-truck"></i>

                        Lanjut Pilih Pengiriman

                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- ====================================================== -->
    <!-- Ringkasan Belanja -->
    <!-- ====================================================== -->

    <div class="col-lg-4">

        <div class="card shadow-sm border-0 sticky-top">

            <div class="card-body">

                <h4 class="fw-bold mb-4">

                    Ringkasan Belanja

                </h4>

                <?php foreach ($cart as $item) : ?>

                    <?php

                    $subtotal = $item['price'] * $item['quantity'];

                    $totalItem += $item['quantity'];

                    $totalPrice += $subtotal;

                    ?>

                    <div class="d-flex justify-content-between mb-3">

                        <div>

                            <strong>

                                <?= htmlspecialchars($item['name']); ?>

                            </strong>

                            <br>

                            <small class="text-muted">

                                <?= $item['quantity']; ?> ×
                                Rp <?= number_format($item['price'], 0, ',', '.'); ?>

                            </small>

                        </div>

                        <strong>

                            Rp <?= number_format($subtotal, 0, ',', '.'); ?>

                        </strong>

                    </div>

                <?php endforeach; ?>

                <hr>

                <div class="d-flex justify-content-between mb-2">

                    <span>

                        Total Item

                    </span>

                    <strong id="total-item">

                        <?= $totalItem; ?>

                    </strong>

                </div>

                <div class="d-flex justify-content-between mb-2">

                    <span>

                        Subtotal

                    </span>

                    <strong id="subtotal">

                        Rp <?= number_format($totalPrice, 0, ',', '.'); ?>

                    </strong>

                </div>

                <div class="d-flex justify-content-between mb-2">

                    <span>

                        Ongkir

                    </span>

                    <strong
                        id="shipping-cost"
                        class="text-success">

                        Rp 0

                    </strong>

                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">

                        Total

                    </h5>

                    <h5
                        id="grand-total"
                        class="text-primary mb-0"
                        data-subtotal="<?= $totalPrice; ?>">

                        Rp <?= number_format($totalPrice, 0, ',', '.'); ?>

                    </h5>

                </div>

                <small
                    id="shipping-service"
                    class="text-muted d-block mt-2">

                    Pilih layanan pengiriman untuk menghitung ongkir.

                </small>

            </div>

        </div>

    </div>

</div>

<?php

require_once APP_PATH . '/views/layouts/footer.php';