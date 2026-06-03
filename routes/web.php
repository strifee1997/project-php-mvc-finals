<?php

declare(strict_types=1);

use App\Controllers\ContactController;

// 1. READ / SEARCH
$router->get('/', [ContactController::class, 'index']);
$router->get('/contacts', [ContactController::class, 'index']);

// 2. CREATE
$router->get('/contacts/create', [ContactController::class, 'create']);
$router->post('/contacts', [ContactController::class, 'store']);

// 3. UPDATE
$router->get('/contacts/{id}/edit', [ContactController::class, 'edit']);
$router->post('/contacts/{id}/edit', [ContactController::class, 'update']);

// 4. DELET
$router->post('/contacts/{id}/delete', [ContactController::class, 'delete']);
$router->get('/about', [ContactController::class, 'about']);
