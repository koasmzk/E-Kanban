<?php
class C_dashboard
{
    public function index(): void
    {
        // Keamanan sederhana: Jika tidak ada session user_id, lempar ke login
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . $GLOBALS['baseURL'] . '/login');
            exit;
        }

        // Panggil View Dashboard
        require_once dirname(__DIR__) . '../../Views/Dashboard/V_dashboard.php';
    }
}