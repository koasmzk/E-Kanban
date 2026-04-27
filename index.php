<?php
session_start();

// ── Definisikan Path Root Project (Wajib ada) ──
define('ROOT', __DIR__);

// ── Deteksi Base URL secara otomatis ──
 $baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
 $baseURL = $baseDir === '/' ? '' : $baseDir;

// Ambil URI dan bersihkan dari Base URL
 $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($baseURL !== '' && str_starts_with($uri, $baseURL)) {
    $uri = substr($uri, strlen($baseURL));
}
 $uri = rtrim($uri, '/') ?: '/';

// Kirim $baseURL ke View agar bisa dipakai di HTML
 $GLOBALS['baseURL'] = $baseURL;

require_once ROOT . '/App/Controllers/Auth/C_register.php'; // Ubah jadi pakai ROOT

 $registerController = new C_register();

switch ($uri) {
    case '/':
        header('Location: ' . $baseURL . '/register');
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