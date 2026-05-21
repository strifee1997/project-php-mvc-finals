<?php

declare(strict_types=1);

// 1. Load the PSR-4 Autoloader
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Application;
use Core\Http\Request;
use Core\Http\Router;
use Core\Database\QueryBuilder;
use Core\Database\MySQLDriver;
use Core\Database\Connection;

// 2. Boot the Application Engine (DI Container)
$app = new Application();

// 3. Register Core Database Infrastructure
$app->bind(QueryBuilder::class, function ($container) {
    $config = require __DIR__ . '/../config/database.php';
    $driver = new MySQLDriver();
    $connection = new Connection($driver, $config);
    return new QueryBuilder($connection->getPdo());
});

// 4. Capture the Incoming HTTP Request
$request = new Request();

// 5. Initialize the Routing Engine
$router = new Router($app);

// 6. Load Application Routes (Cleanly separated!)
require_once __DIR__ . '/../routes/web.php';

// 7. Resolve the matching route and execute
$router->resolve($request);