<?php

declare(strict_types=1);

namespace Framework;

use Framework\Exceptions\ContainerException;
use ReflectionClass;
use ReflectionNamedType;

class Container
{
    private array $definitions = [];
    private array $resolvedDependencies = [];

    public function addDefinitions(array $newDefinitions): void
    {
        $this->definitions = [...$this->definitions, ...$newDefinitions];
    }

    public function resolve(string $className)
    {
        // [1] Check if the class is instantiable
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->isInstantiable())
            throw new ContainerException("Class $className isn't instantiable");

        // [2] Check if the class has a constructor function & if that constructor has parameters
        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) return new $className();

        $params = $constructor->getParameters();
        if (count($params) === 0) return new $className();

        // [3] Validate each parameter's type (to be a class) 
        $dependencies = [];
        foreach ($params as $param) {
            $paramType = $param->getType(); // Null if the param doesn't have a type hint || an instance of the reflection type classes depending on the type hint of the param
            $paramName = $param->getName(); // The variable name stated for the param

            if (!$paramType)
                throw new ContainerException("Failed to resolve class $className because parameter $paramName is missing a type hint");
            if (!$paramType instanceof ReflectionNamedType || $paramType->isBuiltin())
                throw new ContainerException("Failed to resolve class $className because parameter $paramName has invalid type ($paramType)");

            // [4] Check if the param exists in the definitions 
            $dependencyName = $paramType->getName(); // Note that the paramType isn't the actual type string, but an instance of the ReflectionNamedType class

            if (!array_key_exists($dependencyName, $this->definitions))
                throw new ContainerException("Dependency $dependencyName doesn't exist in the container definitions");

            // [5] Get an Instance of the dependency class
            if (array_key_exists($dependencyName, $this->resolvedDependencies)) {
                $depencyInstance = $this->resolvedDependencies[$dependencyName];
            } else {
                $factoryFn = $this->definitions[$dependencyName];
                $depencyInstance = $factoryFn();
                $this->resolvedDependencies[$dependencyName] = $depencyInstance;
            }

            $dependencies[] = $depencyInstance;
        }

        // [5] Finally, return an instance of the class with its dependencies
        return $reflectionClass->newInstanceArgs($dependencies);
    }
}
