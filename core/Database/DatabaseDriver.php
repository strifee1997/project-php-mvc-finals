<?php

declare(strict_types=1);

namespace Core\Database;

use PDO;

interface DatabaseDriver
{
    public function connect(array $config): PDO;
}