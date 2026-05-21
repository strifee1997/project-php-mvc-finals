<?php

declare(strict_types=1);

namespace Core\Http;

readonly class Request
{
    public string $uri;
    public string $method;

    public function __construct()
    {
        // Get the full requested URI
        $rawUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        
        // Get the path to the directory where index.php lives
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        
        // Strip the base directory from the URI so our router only sees the clean route
        if (str_starts_with($rawUri, $scriptDir)) {
            $rawUri = substr($rawUri, strlen($scriptDir));
        }

        // Ensure we always have at least a forward slash
        $this->uri = $rawUri === '' ? '/' : $rawUri;
        
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }
}