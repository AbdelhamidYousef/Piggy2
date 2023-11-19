<?php

declare(strict_types=1);

namespace Framework;

class Framework
{
    private Router $router;
    private Container $container;

    public function __construct()
    {
        $this->router = new Router();
        $this->container = new Container();
    }

    public function run(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method, $this->container);
    }

    public function get(string $path, string $method, array $controller): void
    {
        $this->router->add($path,  $method,  $controller);
    }

    public function addDefinitions(array $definitions): void
    {
        $this->container->addDefinitions($definitions);
    }
}
