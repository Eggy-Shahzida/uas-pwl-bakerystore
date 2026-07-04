<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Base Controller
|--------------------------------------------------------------------------
| Seluruh controller pada aplikasi akan mewarisi class ini.
| Class ini menyediakan method dasar yang sering digunakan,
| seperti menampilkan view, redirect, dan pengecekan request.
*/

class Controller
{
    /**
     * Menampilkan file view.
     *
     * @param string $view Nama folder/file view.
     * @param array $data Data yang dikirim ke view.
     */
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        $viewFile = APP_PATH . '/views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            die("View <b>{$view}</b> tidak ditemukan.");
        }

        require_once $viewFile;
    }

    /**
     * Memuat dan membuat object Model.
     *
     * @param string $model
     * @return object
     */
    protected function model(string $model): object
    {
        $modelFile = APP_PATH . '/models/' . $model . '.php';

        if (!file_exists($modelFile)) {
            die("Model <b>{$model}</b> tidak ditemukan.");
        }

        require_once $modelFile;

        return new $model();
    }

    /**
     * Redirect ke halaman lain.
     *
     * @param string $url
     */
    protected function redirect(string $url): void
    {
        header('Location: ' . BASE_URL . '/' . ltrim($url, '/'));
        exit;
    }

    /**
     * Mengecek apakah request menggunakan metode POST.
     *
     * @return bool
     */
    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Mengecek apakah request menggunakan metode GET.
     *
     * @return bool
     */
    protected function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * Mengecek apakah user sudah login.
     */
    protected function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * Memastikan user sudah login.
     */
    protected function requireLogin(): void
    {
        if (!$this->isLoggedIn()) {

            $this->redirect('login');

        }
    }

    /**
     * Memastikan user adalah admin.
     */
    protected function requireAdmin(): void
    {
        $this->requireLogin();

        if ($_SESSION['user_role'] !== 'admin') {

            die('403 Forbidden');
        }
    }
}