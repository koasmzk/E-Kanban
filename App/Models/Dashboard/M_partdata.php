<?php
require_once dirname(__DIR__) . '/../../Config/ConnectDB.php';

class M_partdata
{
    private PDO $db;

    public function __construct()
    {
        $this->db = ConnectDB::getInstance();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT id, name, part_number, description, created_at FROM parts ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT id, name, part_number, description, created_at FROM parts WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare('INSERT INTO parts (name, part_number, description) VALUES (?, ?, ?)');
        return $stmt->execute([$data['name'], $data['part_number'], $data['description']]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare('UPDATE parts SET name = ?, part_number = ?, description = ? WHERE id = ?');
        return $stmt->execute([$data['name'], $data['part_number'], $data['description'], $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM parts WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function isPartNumberExists(string $partNumber, ?int $excludeId = null): bool
    {
        if ($excludeId) {
            $stmt = $this->db->prepare('SELECT id FROM parts WHERE part_number = ? AND id != ? LIMIT 1');
            $stmt->execute([$partNumber, $excludeId]);
        } else {
            $stmt = $this->db->prepare('SELECT id FROM parts WHERE part_number = ? LIMIT 1');
            $stmt->execute([$partNumber]);
        }
        return (bool) $stmt->fetch();
    }
}