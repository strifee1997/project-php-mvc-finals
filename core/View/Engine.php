<?php

declare(strict_types=1);

namespace Core\View;

class Engine
{
    public static function render(string $viewName, array $data = []): void
    {
        // Extract array keys into actual PHP variables
        extract($data);

        // Build the path to the views folder
        $file = __DIR__ . "/../../app/Views/{$viewName}.php";

        if (file_exists($file)) {
            require $file;
        } else {
            http_response_code(404);
            die("View template '{$viewName}' not found!");
        }
    }
}