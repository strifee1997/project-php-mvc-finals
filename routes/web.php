<?php

declare(strict_types=1);

use App\Controllers\ContactController;

/**
 * --------------------------------------------------------------------------
 * Web Routes
 * --------------------------------------------------------------------------
 */

// 1. READ / SEARCH
$router->get('/', [ContactController::class, 'index']);
$router->get('/contacts', [ContactController::class, 'index']);

// 2. CREATE
$router->get('/contacts/create', [ContactController::class, 'create']);
$router->post('/contacts', [ContactController::class, 'store']);

// 3. UPDATE (These dynamic {id} routes MUST go after the static routes above)
$router->get('/contacts/{id}/edit', [ContactController::class, 'edit']);
$router->post('/contacts/{id}/edit', [ContactController::class, 'update']);

// 4. DELETE
$router->post('/contacts/{id}/delete', [ContactController::class, 'delete']);