<?php

declare(strict_types=1);

namespace Core\Database;

use PDO;

class Connection
{
    private ?PDO $pdo = null;
    
    public function __construct(
        private DatabaseDriver $driver,
        private array $config
    ) {}

    public function getPdo(): PDO
    {
        if ($this->pdo === null) {
            $this->pdo = $this->driver->connect($this->config);
        }

        return $this->pdo;
    }
}
