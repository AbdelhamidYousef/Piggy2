<?php

declare(strict_types=1);

namespace Framework;

class Framework
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function run(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method);
    }

    public function get(string $path, string $method, array $controller): void
    {
        $this->router->add($path,  $method,  $controller);
    }
}
