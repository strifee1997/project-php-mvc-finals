<?php

declare(strict_types=1);

namespace Core\Http;

use Core\Container\Container;

class Router
{
    protected array $routes = [];

    // Inject the DI Container into the router
    public function __construct(private Container $container)
    {
    }

    public function register(string $method, string $uri, array|callable $action): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri'    => $uri,
            'action' => $action
        ];
    }

    public function get(string $uri, array|callable $action): void
    {
        $this->register('GET', $uri, $action);
    }

    public function post(string $uri, array|callable $action): void
    {
        $this->register('POST', $uri, $action);
    }

    public function resolve(Request $request)
    {
        $uri = $request->uri;
        $method = $request->method;

        foreach ($this->routes as $route) {
            if ($route['method'] === $method) {
                
                // Convert {id} to a regex capture group
                $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_]+)', $route['uri']);
                $pattern = "#^" . $pattern . "$#";

                if (preg_match($pattern, $uri, $matches)) {
                    // Extract only the named string parameters (like 'id')
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    $action = $route['action'];

                    // If it's a simple function, execute it
                    if (is_callable($action)) {
                        return call_user_func_array($action, $params);
                    }

                    // If it's a Controller array, e.g., [ContactController::class, 'edit']
                    if (is_array($action)) {
                        [$class, $classMethod] = $action;
                        
                        // 1. Ask the DI Container to build the Controller (SOLID!)
                        $controller = $this->container->resolve($class);
                        
                        // 2. Call the method and pass the extracted parameters
                        return call_user_func_array([$controller, $classMethod], $params);
                    }
                }
            }
        }

        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
    }
}