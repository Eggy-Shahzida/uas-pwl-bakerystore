<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Auth Controller
|--------------------------------------------------------------------------
| Controller ini menangani seluruh proses autentikasi pengguna,
| seperti login, register, dan logout.
| Implementasi setiap method akan dibuat secara bertahap.
*/

class AuthController extends Controller
{
    public function showLogin(): void
    {
            $this->view('auth/login', [

                'errors' => [],

                'old' => []

            ]);
    }

    /**
     * Menampilkan halaman login.
     */
    public function login(): void
    {
        
        /*
        |--------------------------------------------------------------------------
        | Memanggil UserModel
        |--------------------------------------------------------------------------
        */
        $userModel = $this->model('UserModel');

        /*
        |--------------------------------------------------------------------------
        | Mengambil data dari form
        |--------------------------------------------------------------------------
        */
        $data = [

            'email' => trim($_POST['email'] ?? ''),

            'password' => trim($_POST['password'] ?? '')

        ];

        /*
        |--------------------------------------------------------------------------
        | Menyimpan error validasi
        |--------------------------------------------------------------------------
        */
        $errors = [];

        /*
        |--------------------------------------------------------------------------
        | Validasi Email
        |--------------------------------------------------------------------------
        */
        if ($data['email'] === '') {

            $errors['email'] = 'Email tidak boleh kosong.';

        }

        /*
        |--------------------------------------------------------------------------
        | Validasi Password
        |--------------------------------------------------------------------------
        */
        if ($data['password'] === '') {

            $errors['password'] = 'Password tidak boleh kosong.';

        }

        /*
        |--------------------------------------------------------------------------
        | Jika validasi gagal
        |--------------------------------------------------------------------------
        */
        if (!empty($errors)) {

            $this->view('auth/login', [

                'errors' => $errors,

                'old' => $data

            ]);

            return;

        }

        /*
        |--------------------------------------------------------------------------
        | Cari user berdasarkan email
        |--------------------------------------------------------------------------
        */

        $user = $userModel->findByEmail($data['email']);

        /*
        |--------------------------------------------------------------------------
        | Email tidak ditemukan
        |--------------------------------------------------------------------------
        */

        if (!$user) {

            $this->view('auth/login', [

                'errors' => [

                    'general' => 'Email atau password salah.'

                ],

                'old' => $data

            ]);

            return;

        }

        /*
        |--------------------------------------------------------------------------
        | Verifikasi Password
        |--------------------------------------------------------------------------
        */

        if (!password_verify($data['password'], $user['password'])) {

            $this->view('auth/login', [

                'errors' => [

                    'general' => 'Email atau password salah.'

                ],

                'old' => $data

            ]);

            return;

        }

        /*
        |--------------------------------------------------------------------------
        | Login berhasil
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | Simpan Data Login ke Session
        |--------------------------------------------------------------------------
        */

        $_SESSION['user_id'] = $user['id'];

        $_SESSION['user_name'] = $user['name'];

        $_SESSION['user_role'] = $user['role'];

        /*
        |--------------------------------------------------------------------------
        | Redirect berdasarkan Role
        |--------------------------------------------------------------------------
        */

        if ($user['role'] === 'admin') {

            $this->redirect('admin');

        }

        $this->redirect('');

    }

    /**
     * Menampilkan halaman register.
     */
    public function showRegister(): void
    {
        $this->view('auth/register');
    }

    /**
     * proses ketika pengguna menekan tombol "Register" pada form register.
     * Mendaftarkan pengguna baru.
     */
    public function register(): void
    {
            $userModel = $this->model('UserModel');
            $confirmPassword = $_POST['confirm_password'] ?? '';

            $data = [

                'name' => trim($_POST['name']),

                'email' => trim($_POST['email']),

                'password' => trim($_POST['password']),

                // Role tidak berasal dari form
                'role' => 'customer'

            ];

            $errors = [];

            /*
            |--------------------------------------------------------------------------
            | Validasi Nama
            |--------------------------------------------------------------------------
            */

            if ($data['name'] === '') {

                $errors['name'] = 'Nama lengkap wajib diisi.';

            } elseif (!preg_match('/^[a-zA-Z\s]+$/', $data['name'])) {

                $errors['name'] = 'Nama hanya boleh berisi huruf dan spasi.';

            }

            /*
            |--------------------------------------------------------------------------
            | Validasi Email
            |--------------------------------------------------------------------------
            */

            if ($data['email'] === '') {

                $errors['email'] = 'Email tidak boleh kosong.';

            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

                $errors['email'] = 'Format email tidak valid.';

            } elseif ($userModel->findByEmail($data['email'])) {

                $errors['email'] = 'Email sudah terdaftar.';
            }

            /*
            |--------------------------------------------------------------------------
            | Validasi Password
            |--------------------------------------------------------------------------
            */

            if (strlen($data['password']) < 6) {

                $errors['password'] = 'Password minimal 6 karakter.';
            }
            /*
            |--------------------------------------------------------------------------
            | Validasi Konfirmasi Password
            |--------------------------------------------------------------------------
            */

            if ($confirmPassword === '') {

                $errors['confirm_password'] =
                    'Konfirmasi password wajib diisi.';

            }

            elseif ($data['password'] !== $confirmPassword) {

                $errors['confirm_password'] =
                    'Konfirmasi password tidak sesuai.';

            }

            /*
            |--------------------------------------------------------------------------
            | Jika terdapat error
            |--------------------------------------------------------------------------
            */

            if (!empty($errors)) {

                $this->view('auth/register', [

                    'errors' => $errors,

                    'old' => $data

                ]);

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan User ke Database
            |--------------------------------------------------------------------------
            */

            if ($userModel->create($data)) {

                $this->redirect('login');

            } else {

                $this->view('auth/register', [

                    'errors' => [
                        'general' => 'Registrasi gagal. Silakan coba lagi.'
                    ],

                    'old' => $data

                ]);
            }
        }

    /**
     * Logout pengguna.
     */
    public function logout(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Menghapus seluruh data session
        |--------------------------------------------------------------------------
        */

        $_SESSION = [];

        /*
        |--------------------------------------------------------------------------
        | Menghapus cookie session (jika digunakan)
        |--------------------------------------------------------------------------
        */

        if (ini_get('session.use_cookies')) {

            $params = session_get_cookie_params();

            setcookie(

                session_name(),

                '',

                time() - 3600,

                $params['path'],

                $params['domain'],

                $params['secure'],

                $params['httponly']

            );

        }

        /*
        |--------------------------------------------------------------------------
        | Menghancurkan session
        |--------------------------------------------------------------------------
        */

        session_destroy();

        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman login
        |--------------------------------------------------------------------------
        */

        $this->redirect('login');
    }
}