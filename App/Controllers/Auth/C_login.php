<?php
class C_login
{
    public function index(): void
    {
        require_once dirname(__DIR__) . '../../Views/Auth/V_login.php';
    }

    public function auth(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $GLOBALS['baseURL'] . '/login');
            exit;
        }

        // DUMMY AUTH
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = 'AdminDummy';
        $_SESSION['role'] = 'admin';

        header('Location: ' . $GLOBALS['baseURL'] . '/dashboard');
        exit;
    }

    // ✮ Fungsi Logout Baru ✮
    public function logout(): void
    {
        session_unset();
        $_SESSION = [];
        session_destroy();

        header('Location: ' . $GLOBALS['baseURL'] . '/login');
        exit;
    }
}