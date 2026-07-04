<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - BreadShop</title>
</head>

<body>

    <h2>Login BreadShop</h2>

    <?php if (!empty($errors['general'])) : ?>

        <p style="color:red;">
            <?= $errors['general']; ?>
        </p>

    <?php endif; ?>

    <form action="<?= BASE_URL; ?>/login" method="POST">

        <p>

            <label>Email</label><br>

            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($old['email'] ?? '') ?>">

            <br>

            <small style="color:red;">
                <?= $errors['email'] ?? '' ?>
            </small>

        </p>

        <p>

            <label>Password</label><br>

            <input
                type="password"
                name="password">

            <br>

            <small style="color:red;">
                <?= $errors['password'] ?? '' ?>
            </small>

        </p>

        <button type="submit">

            Login

        </button>

    </form>

    <p>

        Belum punya akun?

        <a href="<?= BASE_URL; ?>/register">

            Register

        </a>

    </p>

</body>

</html>