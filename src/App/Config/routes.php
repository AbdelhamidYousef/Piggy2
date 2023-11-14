<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\HomeController;
use Framework\Framework;

function registerRoutes(Framework $framework): void
{
    $routes = [
        ['/', 'GET', [HomeController::class, 'render']]
    ];

    foreach ($routes as $route) {
        $framework->get(...$route);
    }
}
