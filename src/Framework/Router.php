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

    public function dispatch(string $path, string $method): void
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if ($path !== $route['path'] || $method !== $route['method']) continue;

            $controller = $route['controller'];
            $controllerName = $controller[0];
            $controllerFn = $controller[1];

            $controllerInstance = new $controllerName();
            $controllerInstance->$controllerFn();
        }
    }

    private function normalizePath(string $path): string
    {
        $path = '/' . trim($path, '/') . '/';
        $path = preg_replace('#^[/]{2,}$#', '/', $path);
        return $path;
    }
}
