<?php
// Single Responsibility Principle
declare(strict_types=1);

namespace Core\Http;

readonly class Request
{
    public string $uri;
    public string $method;

    public function __construct()
    {
        $rawUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH); //extraxt url
        
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        
        if (str_starts_with($rawUri, $scriptDir)) {
            $rawUri = substr($rawUri, strlen($scriptDir));
        }

        $this->uri = $rawUri === '' ? '/' : $rawUri;
        
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }
}
