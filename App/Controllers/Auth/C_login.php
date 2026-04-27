<?php
class C_login
{
    public function index(): void
    {
        // Memanggil View Login yang sudah Anda buat
        require_once dirname(__DIR__) . '../../Views/Auth/V_login.php';
    }
}