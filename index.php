<?php
session_start();

// ── DETEKSI BASE URL SECARA OTOMATIS ──
 $baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', $baseDir === '/' ? '' : $baseDir);

 $uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Hapus base folder dari URI agar routing tetap bersih
if (BASE_URL !== '' && str_starts_with($uri, BASE_URL)) {
    $uri = substr($uri, strlen(BASE_URL));
}
 $uri  = rtrim($uri, '/') ?: '/';

require_once __DIR__ . '/App/Controllers/Auth/C_register.php';

 $registerController = new C_register();

switch ($uri) {
    case '/':
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/register');
        } else {
            header('Location: ' . BASE_URL . '/dashboard');
        }
        exit;
        break;

    case '/register':
        $registerController->index();
        break;

    case '/register/store':
        $registerController->store();
        break;

    default:
        http_response_code(404);
        echo "404 - Page Not Found";
        break;
}