<?php
// Sesuaikan path ke ConnectDB.php (naik 3 level dari App/Models/Auth/ ke root)
require_once dirname(__DIR__, 3) . '../../../Config/Connection/ConnectDB.php';

class M_register
{
    private PDO $db;

    public function __construct()
    {
        $this->db = ConnectDB::getInstance();
    }

    /**
     * Cek apakah username sudah ada di database
     */
    public function isUsernameExists(string $username): bool
    {
        $sql  = "SELECT id FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->fetch() !== false;
    }

    /**
     * Cek apakah email sudah ada di database
     */
    public function isEmailExists(string $email): bool
    {
        $sql  = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch() !== false;
    }

    /**
     * Simpan data user baru ke database
     */
    public function createUser(array $data): bool
    {
        $sql = "INSERT INTO users (name, username, email, password, role) 
                VALUES (:name, :username, :email, :password, :role)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name'     => $data['name'],
            ':username' => $data['username'],
            ':email'    => $data['email'],
            ':password' => $data['password'], // Password sudah di-hash di Controller
            ':role'     => $data['role'] ?? 'member',
        ]);
    }
}