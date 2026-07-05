<?php

/*
|--------------------------------------------------------------------------
| Register View
|--------------------------------------------------------------------------
*/

$title = 'Register';

require_once APP_PATH . '/views/layouts/header.php';

?>

<div class="row justify-content-center">

    <div class="col-md-6 col-lg-5">

        <div class="card shadow-sm border-0">

            <div class="card-body p-4">

                <div class="text-center mb-4">

                    <h2 class="fw-bold">

                        <i class="bi bi-shop"></i>

                        BreadShop

                    </h2>

                    <p class="text-muted mb-0">

                        Daftar akun baru

                    </p>

                </div>

                <?php if (!empty($errors['general'])) : ?>

                    <div class="alert alert-danger">

                        <?= htmlspecialchars($errors['general']); ?>

                    </div>

                <?php endif; ?>

                <form
                    action="<?= BASE_URL; ?>/register"
                    method="POST"
                    novalidate>

                    <!-- Nama -->

                    <div class="mb-3">

                        <label
                            for="name"
                            class="form-label">

                            Nama Lengkap

                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            autocomplete="name"
                            value="<?= htmlspecialchars($old['name'] ?? '') ?>">

                        <small
                            id="name-info"
                            class="text-warning d-block mt-1"></small>

                        <?php if (!empty($errors['name'])) : ?>

                            <small class="text-danger d-block">

                                <?= htmlspecialchars($errors['name']); ?>

                            </small>

                        <?php endif; ?>

                    </div>

                    <!-- Email -->

                    <div class="mb-3">

                        <label
                            for="email"
                            class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            autocomplete="email"
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>">

                        <?php if (!empty($errors['email'])) : ?>

                            <small class="text-danger d-block">

                                <?= htmlspecialchars($errors['email']); ?>

                            </small>

                        <?php endif; ?>

                    </div>

                    <!-- Password -->

                    <div class="mb-2">

                        <label
                            for="password"
                            class="form-label">

                            Password

                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                autocomplete="new-password">

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                id="toggle-password">

                                <i
                                    id="password-icon"
                                    class="bi bi-eye">
                                </i>

                            </button>

                        </div>

                        <?php if (!empty($errors['password'])) : ?>

                            <small class="text-danger d-block">

                                <?= htmlspecialchars($errors['password']); ?>

                            </small>

                        <?php endif; ?>

                    </div>

                    <!-- Password Strength -->

                    <div class="mb-1">

                        <div
                            class="progress"
                            style="height:8px;">

                            <div
                                id="password-strength-bar"
                                class="progress-bar"
                                role="progressbar"
                                style="width:0%;">

                            </div>

                        </div>

                    </div>

                    <!-- Konfirmasi Password -->

                    <div class="mb-4">

                        <label
                            for="confirm_password"
                            class="form-label">

                            Konfirmasi Password

                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                id="confirm_password"
                                name="confirm_password"
                                class="form-control"
                                autocomplete="new-password">

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                id="toggle-confirm-password">

                                <i
                                    id="confirm-password-icon"
                                    class="bi bi-eye">
                                </i>

                            </button>

                        </div>

                        <small
                            id="confirm-password-info"
                            class="d-block mt-1">
                        </small>
                        <?php if (!empty($errors['confirm_password'])) : ?>

                        <small class="text-danger d-block">

                            <?= htmlspecialchars($errors['confirm_password']); ?>

                        </small>

                    <?php endif; ?>

                    </div>

                    <small
                        id="confirm-password-info"
                        class="d-block mt-1 text-muted">

                    </small>

                    <button
                        type="submit"
                        class="btn btn-primary w-100">

                        <i class="bi bi-person-plus"></i>

                        Daftar Sekarang

                    </button>

                </form>

                <hr>

                <p class="text-center mb-0">

                    Sudah memiliki akun?

                    <a href="<?= BASE_URL; ?>/login">

                        Login

                    </a>

                </p>

            </div>

        </div>

    </div>

</div>

<?php

/*
|--------------------------------------------------------------------------
| JavaScript Khusus Halaman Register
|--------------------------------------------------------------------------
*/

$scripts = [

    'register.js'

];

require_once APP_PATH . '/views/layouts/footer.php';

?>