<?php
// Panggil Model menggunakan ROOT (pasti akurat)
require_once ROOT . '/App/Models/Dashboard/M_partdata.php';

class C_partdata
{
    private M_partdata $model;

    public function __construct()
    {
        $this->model = new M_partdata();
    }

    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . $GLOBALS['baseURL'] . '/login');
            exit;
        }

        $parts = $this->model->getAll();
        
        // Panggil View menggunakan ROOT
        require_once ROOT . '/App/Views/Dashboard/V_partdata.php';
    }

    // ... (method store, update, delete, requireAuth tetap sama persis seperti milik Anda sebelumnya)
    
    public function store(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $GLOBALS['baseURL'] . '/data-part');
            exit;
        }

        $name        = trim($_POST['name'] ?? '');
        $partNumber  = trim($_POST['part_number'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (empty($name) || empty($partNumber)) {
            $_SESSION['flash_error'] = 'Nama dan Part Number wajib diisi.';
            header('Location: ' . $GLOBALS['baseURL'] . '/data-part');
            exit;
        }

        if ($this->model->isPartNumberExists($partNumber)) {
            $_SESSION['flash_error'] = 'Part Number sudah digunakan.';
            header('Location: ' . $GLOBALS['baseURL'] . '/data-part');
            exit;
        }

        $success = $this->model->create([
            'name'        => $name,
            'part_number' => $partNumber,
            'description' => $description,
        ]);

        $_SESSION[$success ? 'flash_success' : 'flash_error'] = $success
            ? 'Data part berhasil ditambahkan.'
            : 'Terjadi kesalahan. Coba lagi.';

        header('Location: ' . $GLOBALS['baseURL'] . '/data-part');
        exit;
    }

    public function update(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $GLOBALS['baseURL'] . '/data-part');
            exit;
        }

        $id          = (int) ($_POST['id'] ?? 0);
        $name        = trim($_POST['name'] ?? '');
        $partNumber  = trim($_POST['part_number'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$id || empty($name) || empty($partNumber)) {
            $_SESSION['flash_error'] = 'Data tidak valid.';
            header('Location: ' . $GLOBALS['baseURL'] . '/data-part');
            exit;
        }

        if ($this->model->isPartNumberExists($partNumber, $id)) {
            $_SESSION['flash_error'] = 'Part Number sudah digunakan part lain.';
            header('Location: ' . $GLOBALS['baseURL'] . '/data-part');
            exit;
        }

        $success = $this->model->update($id, [
            'name'        => $name,
            'part_number' => $partNumber,
            'description' => $description,
        ]);

        $_SESSION[$success ? 'flash_success' : 'flash_error'] = $success
            ? 'Data part berhasil diperbarui.'
            : 'Terjadi kesalahan. Coba lagi.';

        header('Location: ' . $GLOBALS['baseURL'] . '/data-part');
        exit;
    }

    public function delete(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $GLOBALS['baseURL'] . '/data-part');
            exit;
        }

        $id = (int) ($_POST['id'] ?? 0);

        if (!$id) {
            $_SESSION['flash_error'] = 'ID tidak valid.';
            header('Location: ' . $GLOBALS['baseURL'] . '/data-part');
            exit;
        }

        $success = $this->model->delete($id);

        $_SESSION[$success ? 'flash_success' : 'flash_error'] = $success
            ? 'Data part berhasil dihapus.'
            : 'Terjadi kesalahan. Coba lagi.';

        header('Location: ' . $GLOBALS['baseURL'] . '/data-part');
        exit;
    }

    private function requireAuth(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . $GLOBALS['baseURL'] . '/login');
            exit;
        }
    }
}