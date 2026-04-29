<?php
class C_login
{
    public function index(): void
    {
        require_once dirname(__DIR__) . '../../Views/Auth/V_login.php';
    }

    // ── Fungsi baru untuk proses login dummy ──
    public function auth(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $GLOBALS['baseURL'] . '/login');
            exit;
        }

        // ══════ DUMMY AUTH (TANPA CEK DATABASE) ══════
        // Kita langsung set session seolah-olah user berhasil login
        $_SESSION['user_id'] = 1; // ID dummy
        $_SESSION['username'] = 'AdminDummy'; // Username dummy
        $_SESSION['role'] = 'admin'; // Role dummy

        // Redirect ke halaman dashboard
        header('Location: ' . $GLOBALS['baseURL'] . '/dashboard');
        exit;
    }
}