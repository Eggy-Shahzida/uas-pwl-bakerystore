<?php

/*
|--------------------------------------------------------------------------
| Layout Footer
|--------------------------------------------------------------------------
| File ini digunakan sebagai penutup seluruh halaman.
|
| Tugas Footer:
| 1. Menampilkan footer website.
| 2. Memuat Bootstrap JavaScript.
| 3. Memuat JavaScript khusus sesuai halaman.
| 4. Menutup tag HTML.
|--------------------------------------------------------------------------
*/

?>

    </div>
    <!-- End Container -->

    <footer class="bg-white border-top mt-5">

        <div class="container py-4">

            <div class="row">

                <div class="col-md-5">

                    <h5 class="fw-bold">

                        🍞 BreadShop

                    </h5>

                    <p class="text-muted mb-0">

                        BreadShop merupakan website penjualan roti berbasis
                        PHP Native dengan arsitektur MVC sebagai proyek
                        mata kuliah Pemrograman Web Lanjut.

                    </p>

                </div>

                <div class="col-md-3 mt-4 mt-md-0">

                    <h6 class="fw-bold">

                        Menu

                    </h6>

                    <ul class="list-unstyled">

                        <li>

                            <a
                                href="<?= BASE_URL; ?>"
                                class="text-decoration-none text-muted">

                                Home

                            </a>

                        </li>

                        <li>

                            <a
                                href="<?= BASE_URL; ?>/products"
                                class="text-decoration-none text-muted">

                                Produk

                            </a>

                        </li>

                    </ul>

                </div>

                <div class="col-md-4 mt-4 mt-md-0">

                    <h6 class="fw-bold">

                        Akun

                    </h6>

                    <ul class="list-unstyled">

                        <?php if (!isset($_SESSION['user_id'])) : ?>

                            <li>

                                <a
                                    href="<?= BASE_URL; ?>/login"
                                    class="text-decoration-none text-muted">

                                    Login

                                </a>

                            </li>

                            <li>

                                <a
                                    href="<?= BASE_URL; ?>/register"
                                    class="text-decoration-none text-muted">

                                    Register

                                </a>

                            </li>

                        <?php else : ?>

                            <li class="text-muted">

                                Login sebagai

                                <strong>

                                    <?= htmlspecialchars($_SESSION['user_name']); ?>

                                </strong>

                            </li>

                        <?php endif; ?>

                    </ul>

                </div>

            </div>

            <hr>

            <div class="text-center">

                <small class="text-muted">

                    &copy; <?= date('Y'); ?>

                    BreadShop.

                    Seluruh hak cipta dilindungi.

                </small>

            </div>

        </div>

    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    /*
    |--------------------------------------------------------------------------
    | JavaScript Khusus Halaman
    |--------------------------------------------------------------------------
    | Jika suatu View mengirim variabel:
    |
    | $scripts = [
    |     'register.js',
    |     'contoh.js'
    | ];
    |
    | maka footer akan otomatis memuat file tersebut.
    |--------------------------------------------------------------------------
    */
    ?>

    <?php if (!empty($scripts) && is_array($scripts)) : ?>

        <?php foreach ($scripts as $script) : ?>

            <script src="<?= BASE_URL; ?>/assets/js/<?= htmlspecialchars($script); ?>"></script>

        <?php endforeach; ?>

    <?php endif; ?>

</body>

</html>