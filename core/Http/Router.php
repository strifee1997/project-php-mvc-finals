<?php

declare(strict_types=1);

namespace Core\Http;

use Core\Container\Container;

class Router
{
    protected array $routes = [];

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
                
                $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_]+)', $route['uri']);
                $pattern = "#^" . $pattern . "$#";

                if (preg_match($pattern, $uri, $matches)) 
                    {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    $action = $route['action'];

                    if (is_callable($action)) {
                        return call_user_func_array($action, $params);
                    }
                    if (is_array($action)) {
                        [$class, $classMethod] = $action;
                        
                        $controller = $this->container->resolve($class);

                        return call_user_func_array([$controller, $classMethod], $params);
                    }
                }
            }
        }

        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
    }
}
