<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function add(string $path, string $method, array $controller): void
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);
        $this->routes[] = ['path' => $path, 'method' => $method, 'controller' => $controller];
    }

    public function addMiddlewares(array $middlewares): void
    {
        $this->middlewares = [...$middlewares];
    }

    public function dispatch(string $path, string $method, Container $container): void
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if ($path !== $route['path'] || $method !== $route['method']) continue;

            [$controllerName, $controllerFn] = $route['controller'];
            $controllerInstance = $container->resolve($controllerName);
            $action = fn () => $controllerInstance->$controllerFn();

            foreach ($this->middlewares as $middleware) {
                $middlewareInstance = $container->resolve($middleware);
                $action = fn () => $middlewareInstance->process($action);
            }
            $action();

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
