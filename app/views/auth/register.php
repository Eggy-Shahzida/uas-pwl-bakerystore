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

                        <?= $errors['general']; ?>

                    </div>

                <?php endif; ?>

                <form
                    action="<?= BASE_URL; ?>/register"
                    method="POST">

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Lengkap

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="<?= htmlspecialchars($old['name'] ?? '') ?>">

                        <?php if (!empty($errors['name'])) : ?>

                            <small class="text-danger">

                                <?= $errors['name']; ?>

                            </small>

                        <?php endif; ?>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>">

                        <?php if (!empty($errors['email'])) : ?>

                            <small class="text-danger">

                                <?= $errors['email']; ?>

                            </small>

                        <?php endif; ?>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">

                            Password

                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control">

                        <?php if (!empty($errors['password'])) : ?>

                            <small class="text-danger">

                                <?= $errors['password']; ?>

                            </small>

                        <?php endif; ?>

                    </div>

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

require_once APP_PATH . '/views/layouts/footer.php';

?>