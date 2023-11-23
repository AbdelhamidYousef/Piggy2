<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{HomeController, AboutController, RegisterController};
use Framework\Framework;

abstract class RouterManager
{
    private const routes = [
        ['/', 'GET', [HomeController::class, 'render']],
        ['/about', 'GET', [AboutController::class, 'render']],
        ['/register', 'GET', [RegisterController::class, 'render']],
        ['/register', 'POST', [RegisterController::class, 'register']],
    ];

    public static function registerRoutes(Framework $framework): void
    {
        foreach (self::routes as $route) {
            $framework->add(...$route);
        }
    }
}
