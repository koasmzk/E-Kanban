<?php
session_start();

define('ROOT', __DIR__);

 $baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
 $baseURL = $baseDir === '/' ? '' : $baseDir;

 $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($baseURL !== '' && str_starts_with($uri, $baseURL)) {
    $uri = substr($uri, strlen($baseURL));
}
 $uri = rtrim($uri, '/') ?: '/';

 $GLOBALS['baseURL'] = $baseURL;

// ── Panggil Semua Controller ──
require_once ROOT . '/App/Controllers/Auth/C_register.php';
require_once ROOT . '/App/Controllers/Auth/C_login.php';
require_once ROOT . '/App/Controllers/Dashboard/C_dashboard.php';
require_once ROOT . '/App/Controllers/Dashboard/C_partdata.php'; // ✮ Tambahkan ini

 $registerController = new C_register();
 $loginController = new C_login();
 $dashboardController = new C_dashboard();
 $datapartController = new C_partdata(); // ✮ Tambahkan ini

switch ($uri) {
    case '/':
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . $baseURL . '/register');
        } else {
            header('Location: ' . $baseURL . '/dashboard');
        }
        exit;
        break;

    case '/register':
        $registerController->index();
        break;

    case '/register/store':
        $registerController->store();
        break;

    case '/login':
        $loginController->index();
        break;

    case '/login/auth':
        $loginController->auth();
        break;

    case '/dashboard':
        $dashboardController->index();
        break;

    case '/data-part': // ✮ Tambahkan ini SEBELUM default
        $datapartController->index();
        break;

    case '/logout':
        $loginController->logout();
        break;
        
    default:
        http_response_code(404);
        echo "404 - Page Not Found";
        break;
}