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

    <footer class="bg-white border-top py-3 mt-5">

        <div class="container text-center">

            <small class="text-muted">

                &copy; <?= date('Y'); ?>

                BreadShop.

                Dibuat untuk Projek UAS Pemrograman Web Lanjut.

            </small>

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