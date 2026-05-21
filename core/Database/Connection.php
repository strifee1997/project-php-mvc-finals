<?php

declare(strict_types=1);

namespace Core\Database;

use PDO;

class Connection
{
    private ?PDO $pdo = null;

    // Use PHP 8.3 constructor property promotion
    public function __construct(
        private DatabaseDriver $driver,
        private array $config
    ) {}

    public function getPdo(): PDO
    {
        // Singleton pattern: build the connection only once when requested
        if ($this->pdo === null) {
            $this->pdo = $this->driver->connect($this->config);
        }

        return $this->pdo;
    }
}