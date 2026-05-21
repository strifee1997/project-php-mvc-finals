<?php

declare(strict_types=1);

namespace Core\Container;

use Exception;
use ReflectionClass;

class Container
{
    /** * Stores the registered bindings.
     * @var array<string, callable|string>
     */
    private array $bindings = [];

    // The single responsibility of this method is to register an interface to a concrete class
    public function bind(string $abstract, callable|string $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
    }

    // Resolves and instantiates the requested class
    public function resolve(string $abstract): mixed
    {
        // 1. Check if we have a specific binding for this interface
        if (isset($this->bindings[$abstract])) {
            $concrete = $this->bindings[$abstract];
            
            // If it's a callback, execute it
            if (is_callable($concrete)) {
                return $concrete($this);
            }
            // If it's a string, update the abstract to the concrete class name
            $abstract = $concrete;
        }

        // 2. Use PHP Reflection to automatically wire dependencies
        try {
            $reflection = new ReflectionClass($abstract);
        } catch (Exception $e) {
            throw new Exception("Container failed to resolve: {$abstract}. " . $e->getMessage());
        }

        if (!$reflection->isInstantiable()) {
            throw new Exception("Class {$abstract} is not instantiable.");
        }

        $constructor = $reflection->getConstructor();

        // If there's no constructor, just return a new instance
        if (is_null($constructor)) {
            return new $abstract();
        }

        // If there is a constructor, resolve its dependencies recursively
        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            if (!$type || $type->isBuiltin()) {
                throw new Exception("Cannot resolve built-in or missing types in {$abstract}");
            }
            $dependencies[] = $this->resolve($type->getName());
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}