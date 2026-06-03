<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Application;
use Core\Http\Request;
use Core\Http\Router;
use Core\Database\QueryBuilder;
use Core\Database\MySQLDriver;
use Core\Database\Connection;

$app = new Application();

$app->bind(QueryBuilder::class, function ($container) {
    $config = require __DIR__ . '/../config/database.php'; //db settings
    $driver = new MySQLDriver(); //choose db driver
    $connection = new Connection($driver, $config);
    return new QueryBuilder($connection->getPdo());
});

$request = new Request(); //get or post

$router = new Router($app);

require_once __DIR__ . '/../routes/web.php'; //lista sa routes sa web.php

$router->resolve($request); //go!
