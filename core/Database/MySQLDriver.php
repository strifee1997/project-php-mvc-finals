<?php

declare(strict_types=1);

namespace Core\Database;

use PDO;
use PDOException;

class MySQLDriver implements DatabaseDriver
{
    public function connect(array $config): PDO
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        
        try {
            return new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            // In a production app you'd log this, but for now we'll just kill the script
            die("Database connection failed: " . $e->getMessage());
        }
    }
}