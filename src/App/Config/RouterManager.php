<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{HomeController, AboutController};
use Framework\Framework;

abstract class RouterManager
{
    private const routes = [
        ['/', 'GET', [HomeController::class, 'render']],
        ['/about', 'GET', [AboutController::class, 'render']]
    ];

    public static function registerRoutes(Framework $framework): void
    {
        foreach (self::routes as $route) {
            $framework->get(...$route);
        }
    }
}
