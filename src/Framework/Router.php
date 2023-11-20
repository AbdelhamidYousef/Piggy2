<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];

    public function add(string $path, string $method, array $controller): void
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);
        $this->routes[] = ['path' => $path, 'method' => $method, 'controller' => $controller];
    }

    public function dispatch(string $path, string $method, Container $container): void
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if ($path !== $route['path'] || $method !== $route['method']) continue;

            [$controllerName, $controllerFn] = $route['controller'];
            $controllerInstance = $container->resolve($controllerName);
            $controllerInstance->$controllerFn();
            return;
        }
    }

    private function normalizePath(string $path): string
    {
        $path = '/' . trim($path, '/') . '/';
        $path = preg_replace('#^[/]{2,}$#', '/', $path);
        return $path;
    }
}
