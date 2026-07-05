<?php

/*
|--------------------------------------------------------------------------
| Login View
|--------------------------------------------------------------------------
*/

$title = 'Login';

$pageScript = 'login';

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

                        Masuk ke akun Anda

                    </p>

                </div>

                <?php if (!empty($errors['general'])) : ?>

                    <div class="alert alert-danger">

                        <?= htmlspecialchars($errors['general']); ?>

                    </div>

                <?php endif; ?>

                <form
                    action="<?= BASE_URL; ?>/login"
                    method="POST">

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
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>">

                        <?php if (!empty($errors['email'])) : ?>

                            <small class="text-danger">

                                <?= htmlspecialchars($errors['email']); ?>

                            </small>

                        <?php endif; ?>

                    </div>

                    <div class="mb-4">

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
                                class="form-control">

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                id="toggle-password">

                                <i
                                    class="bi bi-eye"
                                    id="password-icon"></i>

                            </button>

                        </div>

                        <?php if (!empty($errors['password'])) : ?>

                            <small class="text-danger">

                                <?= htmlspecialchars($errors['password']); ?>

                            </small>

                        <?php endif; ?>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary w-100">

                        <i class="bi bi-box-arrow-in-right"></i>

                        Login

                    </button>

                </form>

                <hr>

                <p class="text-center mb-0">

                    Belum memiliki akun?

                    <a href="<?= BASE_URL; ?>/register">

                        Daftar

                    </a>

                </p>

            </div>

        </div>

    </div>

</div>

<?php

require_once APP_PATH . '/views/layouts/footer.php';