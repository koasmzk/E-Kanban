<?php
require_once dirname(__DIR__) . '../../Models/Auth/M_login.php';

class C_login
{
    private M_login $model;

    public function __construct()
    {
        $this->model = new M_login();
    }

    public function index(): void
    {
        require_once ROOT . '/App/Views/Auth/V_login.php';
    }

    public function auth(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $GLOBALS['baseURL'] . '/login');
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->model->findByUsername($username);

        if ($user === null || !password_verify($password, $user['password'])) {
            $_SESSION['login_errors'] = ['Username atau password salah.'];
            header('Location: ' . $GLOBALS['baseURL'] . '/login');
            exit;
        }

        session_regenerate_id(true);

        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['name']     = $user['name'];
        $_SESSION['role']     = $user['role'];

        header('Location: ' . $GLOBALS['baseURL'] . '/dashboard');
        exit;
    }

    public function logout(): void
    {
        session_unset();
        $_SESSION = [];
        session_destroy();

        header('Location: ' . $GLOBALS['baseURL'] . '/login');
        exit;
    }
}