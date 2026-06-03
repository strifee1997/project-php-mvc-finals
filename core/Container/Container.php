<?php

declare(strict_types=1);

namespace Core\Container;

use Exception;
use ReflectionClass;

class Container
{
    /** * Stores the registered bindings.
     *
     *  @var array<string, callable|string>
     */
    private array $bindings = [];

    public function bind(string $abstract, callable|string $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function resolve(string $abstract): mixed
    {
        if (isset($this->bindings[$abstract])) {
            $concrete = $this->bindings[$abstract];
            
            if (is_callable($concrete)) {
                return $concrete($this);
            }
            $abstract = $concrete;
        }

        try {
            $reflection = new ReflectionClass($abstract);
        } catch (Exception $e) {
            throw new Exception("Container failed to resolve: {$abstract}. " . $e->getMessage());
        }

        if (!$reflection->isInstantiable()) {
            throw new Exception("Class {$abstract} is not instantiable.");
        }

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return new $abstract();
        }

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
