<?php
require_once dirname(__DIR__) . '../../../Config/Connection/ConnectDB.php';

class M_login
{
    private PDO $db;

    public function __construct()
    {
        $this->db = ConnectDB::getInstance();
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT id, name, username, email, password, role FROM users WHERE username = ? LIMIT 1'
        );
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        return $user ?: null;
    }
}