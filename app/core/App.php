<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Application Router
|--------------------------------------------------------------------------
| Class App bertugas sebagai router sederhana.
| Router membaca URL kemudian menentukan controller, method,
| dan parameter yang akan dijalankan.
*/

class App
{
    /**
     * Menjalankan aplikasi.
     */
    public function run(): void
    {
        $url = $this->getUrl();

        /*
        |--------------------------------------------------------------------------
        | Default Route
        |--------------------------------------------------------------------------
        */

        if (empty($url)) {
            $controller = 'HomeController';
            $method = 'index';
            $params = [];
        } else {
            $params = [];
            switch ($url[0]) {

                case 'login':
                        $controller = 'AuthController';

                        $method = ($_SERVER['REQUEST_METHOD'] === 'POST')
                            ? 'login'
                            : 'showLogin';

                        break;

                case 'register':
                        $controller = 'AuthController';

                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $method = 'register';
                        } else {
                            $method = 'showRegister';
                        }

                        break;

                case 'logout':
                    $controller = 'AuthController';
                    $method = 'logout';
                    break;

                case 'products':
                    $controller = 'ProductController';

                    /*
                    |--------------------------------------------------------------------------
                    | /products
                    |--------------------------------------------------------------------------
                    */

                    if (!isset($url[1])) {

                        $method = 'index';

                        $params = [];

                    } else {

                        /*
                        |--------------------------------------------------------------------------
                        | /products/{slug}
                        |--------------------------------------------------------------------------
                        */

                        $method = 'show';

                        $params = [

                            $url[1]

                        ];

                    }

                    break;

                case 'cart':
                    $controller = 'CartController';

                    if (!isset($url[1])) {

                        $method = 'index';

                        $params = [];

                    } elseif ($url[1] === 'add') {

                        $method = 'add';

                        $params = [];

                    } elseif ($url[1] === 'remove') {

                        $method = 'remove';

                        $params = [];

                    } elseif ($url[1] === 'update') {

                        $method = 'update';

                        $params = [];

                    } else {

                        $method = 'index';

                        $params = [];

                    }

                    break;

                case 'checkout':
                    $controller = 'OrderController';
                    $method = 'checkout';
                    break;

                case 'orders':
                    $controller = 'OrderController';
                    $method = $url[1] ?? 'index';
                    break;

                case 'admin':
                    $controller = 'AdminController';
                    $method = $url[1] ?? 'index';
                    break;

                default:
                    $controller = 'ErrorController';
                    $method = 'notFound';
                    break;
            }

            //$params = array_slice($url, 2);
        }

        $controllerFile = APP_PATH . '/controllers/' . $controller . '.php';

        if (!file_exists($controllerFile)) {
            die("Controller {$controller} tidak ditemukan.");
        }

        require_once $controllerFile;

        $controllerObject = new $controller();

        if (!method_exists($controllerObject, $method)) {
            die("Method {$method} tidak ditemukan.");
        }

        call_user_func_array([$controllerObject, $method], $params);
    }

    /**
     * Mengambil URL dari browser.
     */
    private function getUrl(): array
    {
        if (!isset($_GET['url'])) {
            return [];
        }

        $url = rtrim($_GET['url'], '/');

        $url = filter_var($url, FILTER_SANITIZE_URL);

        return explode('/', $url);
    }
}