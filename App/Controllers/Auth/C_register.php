<?php
// Sesuaikan path ke Model (naik 1 level ke App, lalu masuk Models/Auth)
require_once dirname(__DIR__) . '../../Models/Auth/M_register.php';

class C_register
{
    private M_register $model;

    public function __construct()
    {
        $this->model = new M_register();
    }

    /**
     * Tampilkan halaman register
     */
    public function index(): void
    {
        // Path ke View
        require_once dirname(__DIR__) . '../../Views/Auth/V_register.php';
    }

    /**
     * Proses data dari form register
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit;
        }

        // 1. Ambil & bersihkan input
        $name            = trim(htmlspecialchars($_POST['fullname'] ?? ''));
        $username        = trim(htmlspecialchars($_POST['username'] ?? ''));
        $email           = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
        $password        = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // 2. Validasi
        $errors = [];

        if (empty($name)) {
            $errors[] = 'Nama tidak boleh kosong.';
        }

        if (empty($username)) {
            $errors[] = 'Username tidak boleh kosong.';
        } elseif (!preg_match('/^[a-zA-Z0-9_]{3,50}$/', $username)) {
            $errors[] = 'Username hanya boleh huruf, angka, underscore (3-50 karakter).';
        } elseif ($this->model->isUsernameExists($username)) {
            $errors[] = 'Username sudah digunakan.';
        }

        if (empty($email)) {
            $errors[] = 'Email tidak boleh kosong.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Format email tidak valid.';
        } elseif ($this->model->isEmailExists($email)) {
            $errors[] = 'Email sudah terdaftar.';
        }

        if (empty($password)) {
            $errors[] = 'Password tidak boleh kosong.';
        } elseif (strlen($password) < 8) {
            $errors[] = 'Password minimal 8 karakter.';
        }

        if ($password !== $confirmPassword) {
            $errors[] = 'Konfirmasi password tidak cocok.';
        }

        // 3. Jika ada error, simpan ke session dan redirect kembali
        if (!empty($errors)) {
            $_SESSION['register_errors'] = $errors;
            $_SESSION['old_input'] = compact('name', 'username', 'email');
            header('Location: /register');
            exit;
        }

        // 4. Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // 5. Simpan ke database via Model
        $success = $this->model->createUser([
            'name'     => $name,
            'username' => $username,
            'email'    => $email,
            'password' => $hashedPassword,
            'role'     => 'member',
        ]);

        if ($success) {
            $_SESSION['register_success'] = 'Akun berhasil dibuat! Silakan login.';
            header('Location: /login');
            exit;
        } else {
            $_SESSION['register_errors'] = ['Terjadi kesalahan server. Coba lagi.'];
            header('Location: /register');
            exit;
        }
    }
}