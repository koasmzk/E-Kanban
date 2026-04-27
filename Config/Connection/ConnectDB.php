<?php
class ConnectDB
{
    private static ?PDO $instance = null;

    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $envPath = dirname(__DIR__, 3) . '../../.env';

            if (!file_exists($envPath)) {
                throw new RuntimeException('.env file not found at: ' . $envPath);
            }

            $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $env = [];

            foreach ($lines as $line) {
                if (str_starts_with(trim($line), '#')) continue;
                $parts = explode('=', $line, 2);
                if (count($parts) === 2) {
                    $env[trim($parts[0])] = trim($parts[1]);
                }
            }

            // ── VALIDASI KETAT: Wajib ada di .env, jika tidak ada -> STOP! ──
            $requiredKeys = ['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASS'];
            foreach ($requiredKeys as $key) {
                if (!isset($env[$key]) || $env[$key] === '') {
                    throw new RuntimeException("Kredensial {$key} tidak ditemukan atau kosong di file .env");
                }
            }

            // ── Ambil murni dari .env tanpa fallback ──
            $host = $env['DB_HOST'];
            $port = $env['DB_PORT'];
            $db   = $env['DB_NAME'];
            $user = $env['DB_USER'];
            $pass = $env['DB_PASS'];

            $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";

            try {
                self::$instance = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                throw new RuntimeException('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}